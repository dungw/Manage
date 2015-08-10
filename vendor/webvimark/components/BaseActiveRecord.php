<?php
namespace webvimark\components;

use webvimark\helpers\LittleBigHelper;
use webvimark\image\Image;
use yii\db\ActiveRecord;
use Yii;
use yii\helpers\StringHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class BaseActiveRecord extends ActiveRecord
{
	/**
	 * "thumbDir"=>["dimensions"]
	 * If "dimensions" is not array, then image will be saved without resizing (in original size)
	 *
	 * @var array
	 */
	public $thumbs = [
		'full'   => null,
		'medium' => [300, 300],
		'small'  => [50, 50]
	];


	/**
	 * @param mixed $condition
	 *
	 * @return bool
	 */
	public static function deleteIfExists($condition)
	{
		$model = static::findOne($condition);

		if ( $model )
		{
			$model->delete();
			return true;
		}

		return false;
	}


	/**
	 * Finds the model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 *
	 * @param mixed $condition
	 *
	 * @return static the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	public static function findOneOrException($condition)
	{
		if ( ($model = static::findOne($condition)) !== null )
		{
			return $model;
		}
		else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	/**
	 * getUploadDir
	 *
	 * + Создаёт директории, если их нет
	 *
	 * @return string
	 */
	public function getUploadDir()
	{
		return Yii::getAlias('@webroot') . '/images/' . $this->tableName();
	}

	/**
	 * saveImage
	 *
	 * @param UploadedFile $file
	 * @param string        $imageName
	 */
	public function saveImage($file, $imageName)
	{
		if ( ! $file )
			return;

		$uploadDir = $this->getUploadDir();

		$this->prepareUploadDir($uploadDir);

		if ( is_array($this->thumbs) AND !empty($this->thumbs) )
		{

			foreach ($this->thumbs as $dir => $size)
			{
				$img = Image::factory($file->tempName);

				// If $size is array of dimensions - resize, else - just save
				if ( is_array($size) )
					$img->resize(implode(',', $size))->save($uploadDir . '/'. $dir . '/' . $imageName);
				else
					$img->save($uploadDir . '/'. $dir . '/' . $imageName);
			}

			@unlink($file->tempName);
		}
		else
		{
			$file->saveAs($uploadDir . '/' . $imageName);

		}
	}

	/**
	 * Delete image from all directories
	 *
	 * @param string $image
	 */
	public function deleteImage($image)
	{
		$uploadDir = $this->getUploadDir();

		if ( is_array($this->thumbs) AND !empty($this->thumbs) )
		{
			foreach (array_keys($this->thumbs) as $thumbDir)
				@unlink($uploadDir.'/'.$thumbDir.'/'.$image);
		}
		else
		{
			@unlink($uploadDir.'/'.$image);
		}
	}

	/**
	 * Provide array of image fields (like: ['logo', 'image'])
	 * then $model->$imageField will be deleted from all thumb directories (or main dir if there are no thumbs)
	 *
	 * @param array $imageFields
	 */
	public function bulkDeleteImages($imageFields)
	{
		foreach ($imageFields as $imageField)
		{
			$this->deleteImage($this->$imageField);
		}
	}

	/**
	 * getImageUrl
	 *
	 * @param string|null $dir
	 * @param string $attr
	 * @return string
	 */
	public function getImageUrl($dir = 'full', $attr = 'image')
	{
		if ( $dir )
			return Yii::$app->request->baseUrl . "/images/{$this->tableName()}/{$dir}/".$this->{$attr};
		else
			return Yii::$app->request->baseUrl . "/images/{$this->tableName()}/".$this->{$attr};
	}

	/**
	 * getImagePath
	 *
	 * @param string|null $dir
	 * @param string $attr
	 * @return string
	 */
	public function getImagePath($dir = 'full', $attr = 'image')
	{
		if ( $dir )
			return $this->getUploadDir() . "/{$dir}/".$this->{$attr};
		else
			return $this->getUploadDir() . "/".$this->{$attr};
	}


	//=========== Rules ===========

	public function purgeXSS($attr)
	{
		$this->$attr = htmlspecialchars($this->$attr, ENT_QUOTES);
	}

	//----------- Rules -----------



	/**
	 * prepareUploadDir
	 *
	 * @param string $dir
	 */
	public function prepareUploadDir($dir)
	{
		if (! is_dir($dir))
		{
			mkdir($dir, 0777, true);
			chmod($dir, 0777);
		}

		// Если нужны папки с thumbs
		if ( is_array($this->thumbs) AND !empty($this->thumbs) )
		{
			foreach (array_keys($this->thumbs) as $thumbDir)
			{
				if (! is_dir($dir.'/'.$thumbDir))
				{
					mkdir($dir.'/'.$thumbDir, 0777, true);
					chmod($dir.'/'.$thumbDir, 0777);
				}
			}
		}
	}

	/**
	 * @param UploadedFile $file
	 *
	 * @return string
	 */
	public function generateFileName($file)
	{
		return uniqid() . '_' . LittleBigHelper::slug($file->baseName, '_') . '.' . $file->extension;
	}


	/**
	 * Check if some attributes uploaded via fileInput field
	 * and assign them with UploadedFile
	 *
	 * @inheritdoc
	 */
	public function setAttributes($values, $safeOnly = true)
	{
		parent::setAttributes($values, $safeOnly);

		// Looking only for file attributes (and fix null error on fly)
		if ( is_array($values) )
		{
			$attributes = array_flip($safeOnly ? $this->safeAttributes() : $this->attributes());

			$class = StringHelper::basename(get_called_class());

			foreach ($values as $name => $value)
			{
				if ( isset( $attributes[$name] ) )
				{
					if ( isset($_FILES[$class]['name'][$name]) )
					{
						$uploadedFile = UploadedFile::getInstance($this, $name);

						if ( $uploadedFile )
						{
							$this->$name = $uploadedFile;
						}
						elseif ( ! $this->isNewRecord )
						{
							$this->$name = $this->oldAttributes[$name];
						}
					}
				}
			}
		}
	}


	/**
	 * @inheritdoc
	 */
	public function beforeSave($insert)
	{
		if ( parent::beforeSave($insert) )
		{
			foreach ($this->attributes as $name => $val)
			{
				if ( $val instanceof UploadedFile )
				{
					if ( $val->name AND !$val->hasError )
					{
						$fileName = $this->generateFileName($val);

						if ( !$this->isNewRecord )
						{
							$this->deleteImage($this->oldAttributes[$name]);
						}

						$this->saveImage($val, $fileName);

						$this->$name = $fileName;
					}
					elseif ( !$this->isNewRecord )
					{
						$this->$name = $this->oldAttributes[$name];
					}
				}
			}

			return true;
		}

		return false;
	}

} 
