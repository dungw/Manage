<?php
/**
 * Example class to demonstrate how the ClsSocketServer class works
 * An easy and raw chat room server
 *
 * @author Cyril Mazur    www.cyrilmazur.com    twitter.com/CyrilMazur    facebook.com/CyrilMazur
 */
class ClsMyExampleServer extends ClsSocketServer
{

    /**
     * When data is received
     * @param resource $soket
     * @param string $data
     */
    protected function onDataReceived($socket, $data)
    {

        $this->log($socket . ' sent: ' . $data);

        // and send back to all the users what he just said
        $this->sendBack($socket, 'What do you mean \'' . $data . '\'?');
    }

    /**
     * When a new client connects
     * @param resource $socket
     */
    protected function onClientConnected($socket)
    {
        $this->log('New client connected: ' . $socket);

        // and send back to all the users
//		$this->sendBroadcast($socket . ' entered the room');
    }

    /**
     * When a client disconnects
     * @param resource $socket
     */
    protected function onClientDisconnected($socket)
    {
        $this->log($socket . ' disconnected');

        // and send back to all the users
//		$this->sendBroadcast($socket . ' left the room');
    }
}

?>