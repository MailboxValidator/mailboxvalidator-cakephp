<?php
namespace MailboxValidatorCakePHP\Controller;

use Cake\Core\Configure;

class MailboxValidatorController{

    private $source = 'cakephp';
    private $singleValidationApiUrl = 'https://api.mailboxvalidator.com/v2/validation/single';
    private $disposableEmailApiUrl = 'https://api.mailboxvalidator.com/v2/email/disposable';
    private $freeEmailApiUrl = 'https://api.mailboxvalidator.com/v2/email/free';
    
    public function __construct()
    {
        $this->api_key = Configure::read('MBV_API_KEY');
    }
    
    public function __destruct()
    {
    
    }

    public function single ($email) {
        if (trim($email) != '') {
            try {
                $params = [ 'email' => $email, 'key' => $this->api_key, 'format' => 'json', 'source' => $this->source ];
                $params2 = [];
                foreach ($params as $key => $value) {
                    $params2[] = $key . '=' . rawurlencode($value);
                }
                $params = implode('&', $params2);
                
                $results = file_get_contents($this->singleValidationApiUrl . '?' . $params);
                
                if ($results !== false) {
                    if (!isset($results->error)) {
                        $data = json_decode($results,true);
                        if ( $data['status'] ) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            } catch (Exception $e) {
                return true;
            }
         } else {
            return true;
         }
    }

    public function disposable ($email) {
        if (trim($email) != '') {
            try {
                $params = [ 'email' => $email, 'key' => $this->api_key, 'format' => 'json', 'source' => $this->source ];
                $params2 = [];
                foreach ($params as $key => $value) {
                    $params2[] = $key . '=' . rawurlencode($value);
                }
                $params = implode('&', $params2);
                
                $results = file_get_contents($this->disposableEmailApiUrl . '?' . $params);
                
                if ($results !== false) {
                    if (!isset($results->error)) {
                        $data = json_decode($results, true);
                        Log::write('debug', json_encode($data));
                        if ( $data['is_disposable'] ) {
                            return false;
                        } else {
                            return true;
                        }
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            } catch (Exception $e) {
                return true;
            }
         } else {
            return true;
         }
    }

    public function free($email){
        if (trim($email) != '') {
            try {
                $params = [ 'email' => $email, 'key' => $this->api_key, 'format' => 'json', 'source' => $this->source ];
                $params2 = [];
                foreach ($params as $key => $value) {
                    $params2[] = $key . '=' . rawurlencode($value);
                }
                $params = implode('&', $params2);
                
                $results = file_get_contents($this->freeEmailApiUrl . '?' . $params);
                
                if ($results !== false) {
                    if (!isset($results->error)) {
                        $data = json_decode($results,true);
                        if ( $data['is_free'] ) {
                            return false;
                        } else {
                            return true;
                        }
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            } catch (Exception $e) {
                return true;
            }
        } else {
            return true;
         }
    }

}