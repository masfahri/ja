<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
Copyright (C) 2011 by Jim Saunders

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

class Github_updater
{
    const API_URL = 'https://api.github.com/';
    const GITHUB_URL = 'https://github.com/';
    const CONFIG_FILE = 'application/config/github_updater.php';

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->config('github_updater');
    }

    /**
     * Checks if the current version is up to date
     *
     * @return bool true if there is an update and false otherwise
     */
    public function has_update()
    {
        $branches = json_decode($this->_connect('https://api.github.com/repos/'.$this->ci->config->item('github_user').'/'.$this->ci->config->item('github_repo').'/branches'));
        if($branches[0]->commit->sha !== $this->ci->config->item('current_commit')) {
            return 1;            
        }else{
            return 0;
        }

    }

    /**
     * Performs an update if one is available.
     *
     * @return bool true on success, false on failure
     */
    public function update()
    {
        $branches = json_decode($this->_connect('https://api.github.com/repos/'.$this->ci->config->item('github_user').'/'.$this->ci->config->item('github_repo').'/branches'));
        $hash = $branches[0]->commit->sha;
        if($hash !== $this->ci->config->item('current_commit'))
        {
            $commits = json_decode($this->_connect('https://api.github.com/repos/'.$this->ci->config->item('github_user').'/'.$this->ci->config->item('github_repo').'/compare/'.$this->ci->config->item('current_commit').'...'.$hash));
            $files = $commits->files;       
            if($dir = $this->_get_and_extract($hash))
            {
                var_dump($dir);die;
                //Loop through the list of changed files for this commit
                foreach($files as $file)
                {
                    //If the file isn't in the ignored list then perform the update
                    if(array_search($file->filename, $this->ci->config->item('ignored_files')) === false)
                    {
                        //If the status is removed then delete the file
                        if($file->status === 'removed')unlink($file->filename);
                        //Otherwise copy the file from the update.
                        else copy($dir.'/'.$file->filename, $file->filename);
                    }
                }
                //Clean up
                if($this->ci->config->item('clean_update_files') === true)
                {
                    shell_exec("sudo rm -rf ".str_replace($_SERVER['SCRIPT_NAME'],'', $_SERVER['SCRIPT_FILENAME'])."/jempolasik/patch/update.zip");
                    unlink(str_replace($_SERVER['SCRIPT_NAME'],'', $_SERVER['SCRIPT_FILENAME'])."/jempolasik/patch/update.zip");
                }
                //Update the current commit hash
                $this->_set_config_hash($hash);
                $this->sessions->set_user_data('hash', $hash);
                return true;
            }
        }
        return false;
    }

    private function _set_config_hash($hash)
    {
        $lines = file('application/config/github_updater.php', FILE_IGNORE_NEW_LINES);
        $count = count($lines);
        for($i=0; $i < $count; $i++)
        {
            $configline = '$config[\'current_commit\']';
            if(strstr($lines[$i], $configline))
            {
                $lines[$i] = $configline.' = \''.$hash.'\';';
                $file = implode(PHP_EOL, $lines);
                $handle = @fopen('application/config/github_updater.php', 'w');
                fwrite($handle, $file);
                fclose($handle);
                return true;
            }
        }
        return false;
    }

    private function _get_and_extract($hash)
    {

        copy('https://github.com/'.$this->ci->config->item('github_user').'/'.$this->ci->config->item('github_repo').'/zipball/'.$this->ci->config->item('github_branch'), str_replace($_SERVER['SCRIPT_NAME'],'', $_SERVER['SCRIPT_FILENAME'])."/jempolasik/patch/update.zip");
        shell_exec("unzip " .str_replace($_SERVER['SCRIPT_NAME'],'', $_SERVER['SCRIPT_FILENAME'])."/jempolasik/patch/update.zip -d ".str_replace($_SERVER['SCRIPT_NAME'],'', $_SERVER['SCRIPT_FILENAME'])."/jempolasik/patch/");
        $files = scandir('.');
        foreach($files as $file) {
            $shorthash = $hash[0] . $hash[1] . $hash[2] . $hash[3] . $hash[4] . $hash[5] . $hash[6];
            if(strpos($file, $this->ci->config->item('github_user').'-'.$this->ci->config->item('github_repo').'-'.$shorthash) !== FALSE){
                return $file;
            }
        }
    }

    private function _connect($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}