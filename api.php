<?php

require_once 'vendor/autoload.php';

class Api {

    public function __construct(){
        # Set header to application/json
        header('Content-type: application/json; charset=UTF-8');
        # If GET method, getLink is requested.
        if(isset($_GET['i'])){
            $this->setProperties();
            try{
                $this->getLink($_GET['i']);
            }catch (Exception $e){
                $answer = array(
                    'status' => 'error',
                    'message' => 'Key doesn\'t exist',
                    'method' => 'GET'
                );

                echo json_encode($answer);
            }
        # If POST method, getLink is requested.
        }else if(isset($_POST['i'])){
            $this->setProperties();

            try{
                $this->getLink($_POST['i']);
            }catch(Exception $e){
                $answer = array(
                    'status' => 'error',
                    'message' => 'Key doesn\'t exist.',
                    'method' => 'POST'
                );

                echo json_encode($answer);
            }

        # If GET method, setLink is requested.
        }else if(isset($_GET['l'])){
            $this->setProperties();
            # TODO: Validate link
            $key = $this->genKey();
            $val = $_GET['l'];
            if(isset($_GET['e']) && isset($_GET['t'])){
                # TODO: Validate expire
                $expire = $_GET['e'];
                $ttl = $_GET['t'];
            }else{
                $expire = false;
                $ttl = 0;
            }
            $this->setLink($key, $val, $expire, $ttl);

            $answer = array(
                'status' => 'success',
                'message' => 'Key-link has been successfully created.',
                'method' => 'GET',
                'key' => $key
            );

            echo json_encode($answer);

        # If POST method, setLink is requested.
        }else if(isset($_POST['l'])){
            $this->setProperties();
            # TODO: Validate link
            $key = $_POST['k'];
            $val = $_POST['l'];
            if(isset($_POST['e']) && isset($_POST['t'])){
                # TODO: Validate expire
                $expire = $_POST['e'];
                $ttl = $_POST['t'];
            }else{
                $expire = false;
                $ttl = 0;
            }
            $this->setLink($key, $val, $expire, $ttl);

            $answer = array(
                'status' => 'success',
                'message' => 'Key-link has been successfully created.',
                'method' => 'POST',
                'key' => $key
            );

            echo json_encode($answer);

        }else{
            $answer = array(
                'status' => 'error',
                'message' => 'Invalid API request.'
            );

            echo json_encode($answer);
        }
    }

    private function setProperties(){
        $this->client = new Predis\Client();
        $this->domain = 'tikli';
    }

    private function genKey(){
        /*
         * Description: Creates a base58, randomly generated key.
         */
        $base58 = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        $randomKey = '';
        for($i = 0; $i < 8; $i++){
            $randomKey .= $base58[rand(0, strlen($base58) - 1)];
        }
        return $randomKey;
    }

    public function setLink($key, $val, $expire, $ttl){
        /*
         * Description: Create a new key-link. Also logs to site stats.
         */
        $data = $this->domain . ':' . $key;

        if($this->client->exists($data)){
            throw new Exception('Key exists.');
        }else{
            # Create the key-link
            $this->client->set($data, $val);
            # Add to site link stats
            $this->setSiteStat('link');

            if($expire == true){
                $this->client->expire($key, $ttl);
            }
        }
    }

    public function getLink($id){
        /*
         * Description: Get a key-link. Also logs to site stats.
         */
        $data = $this->domain . ':' . $id;

        if($this->client->exists($data)){
            # Get the link of the key
            $link = $this->client->get($data);
            # Add to site hit stats
            $this->setSiteStat('hit');

            return $link;
        }else{
            throw new Exception('Key doesn\'t exist.');
        }
    }

    public function setSiteStat($type){
        /*
         * Description: Logs link creations and hits to site stats.
         */
        if($type == 'hit'){
            # Create site hit stats key structure
            $data['day'] = $this->domain . '.stat.day_hit';
            $data['week'] = $this->domain . '.stat.week_hit';
            $data['month'] = $this->domain . '.stat.month_hit';
            $data['total'] = $this->domain . '.stat.total_hit';

            # Log daily stats
            if(!$this->client->exists($data['day'])){
                $this->client->hset($data['day'], 'field', '0');
                # Add TTL by 24 hours
                $this->client->expire($data['day'], 60 * 60 * 24);
            }else{
                $this->client->hincrby($data['day'], 'field', '1');
            }

            # Log weekly stats
            if(!$this->client->exists($data['week'])){
               $this->client->hset($data['week'], 'field', '0');
                # Add TTL by 7 days
                $this->client->expire($data['week'], 60 * 60 * 24 * 7);
            }else{
                $this->client->hincrby($data['week'], 'field', '1');
            }

            # Log monthly stats
            if(!$this->client->exists($data['month'])){
                $this->client->hset($data['month'], 'field', '0');
                # Add TTL by 30 days
                $this->client->expire($data['month'], 60 * 60 * 24 * 30);
            }else{
                $this->client->hincrby($data['month'], 'field', '1');
            }

            # Log total stats
            $this->client->hincrby($data['total'], 'field', '1');

        }else if($type == 'link'){
            # Create site link stats key structure
            $data['day'] = $this->domain . '.stat.day_link';
            $data['week'] = $this->domain . '.stat.week_link';
            $data['month'] = $this->domain . '.stat.month_link';
            $data['total'] = $this->domain . '.stat.total_link';

            # Log daily stats
            if(!$this->client->exists($data['day'])){
                $this->client->hset($data['day'], 'field', '0');
                # Add TTL by 24 hours
                $this->client->expire($data['day'], 60 * 60 * 24);
            }else{
                $this->client->hincrby($data['day'], 'field', '1');
            }

            # Log weekly stats
            if(!$this->client->exists($data['week'])){
                $this->client->hset($data['week'], 'field', '0');
                # Add TTL by 7 days
                $this->client->expire($data['week'], 60 * 60 * 24 * 7);
            }else{
                $this->client->hincrby($data['week'], 'field', '1');
            }

            # Log monthly stats
            if(!$this->client->exists($data['month'])){
                $this->client->hset($data['month'], 'field', '0');
                # Add TTL by 30 days
                $this->client->expire($data['month'], 60 * 60 * 24 * 30);
            }else{
                $this->client->hincrby($data['month'], 'field', '1');
            }

            # Log total stats
            $this->client->hincrby($data['total'], 'field', '1');
        }
    }


}