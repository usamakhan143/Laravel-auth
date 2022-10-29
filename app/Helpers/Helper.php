<?php

namespace App\Helpers;

class Helper {

    //Main Function for all the policies
    protected static function getPermissions($modelName, $permission_name)
    {
        foreach ($modelName->roles as $role) 
        {
            foreach ($role->permission as $ijazat)
            {
                if ($ijazat->name == $permission_name)
                {
                    return true;
                }
            }
        }

        return false;
    }

    public static function getCurrentMac() {

        $connected = @fsockopen("www.google.com", 80);
        if($connected) {
            fclose($connected);
            $arp = `arp -a`;
            $lines = explode("\n", $arp);
            $devices = array();
            foreach ($lines as $line) {
                $cols = preg_split('/\s+/', trim($line));
                if (isset($cols[2]) && $cols[2] == 'dynamic') {
                    $temp = array();
                    $temp['ip'] = $cols[0];
                    $temp['mac'] = $cols[1];
                    $devices[] = $temp;
                }
            }
            $currentNetwork_Address = $devices[0]['mac'];
        }
        else {
            $currentNetwork_Address = false;
        }
        return $currentNetwork_Address;
    }

}