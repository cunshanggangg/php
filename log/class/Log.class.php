<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/17
 * Time: 17:01
 */
date_default_timezone_set("PRC");
class logs
{
    private $FilePath;
    private $FileName;
    private $m_MaxLogFileNum;
    private $m_RotaType;
    private $m_RotaParam; //文件大小
    private $m_InitOk;
    private $m_Priority;
    private $m_LogCount;

    /**
     * @abstract 初始化
     * @param String $dir 文件路径
     * @param String $filename 文件名
     */
    public function __construct($className='',$priority = self::INFO, $maxlogfilenum = 3, $rotatype = 1, $rotaparam = 5000000)
    {
        /*
        $dot_offset = strpos($filename, ".");
        if ($dot_offset !== false)
            $this->FileName = substr($filename,0, $dot_offset);
        else
            $this->FileName = $filename;
        */
        $this->FileName = date("Ymd",time());
        $this->FilePath = 'log'.'/'.date("Ymd",time())."/";
        $this->m_MaxLogFileNum = intval($maxlogfilenum);
        $this->m_RotaParam = intval($rotaparam);
        $this->m_RotaType = intval($rotatype);
        $this->m_Priority = intval($priority);
        $this->m_LogCount = 0;

        $this->m_InitOk = $this->InitDir();
        umask(0000);
        $path=$this->FilePath.$this->FileName.".log";
        if(!$this->isExist($path))
        {
            if(!$this->createDir($this->FilePath))
            {
                #echo("创建目录失败!");
            }
            if(!$this->createLogFile($path)){
                #echo("创建文件失败!");
            }
        }
    }

    private function InitDir()
    {
        if (is_dir($this->FilePath) === false)
        {
            if(!$this->createDir($this->FilePath))
            {
                //echo("创建目录失败!");
                //throw exception
                return false;
            }
        }
        return true;
    }

    /**
     * @abstract 写入日志
     * @param String $log 内容
     */
    public function setLog($log)
    {
        $this->Log(self::NOTICE, $log);
    }

    public function LogDebug($log)
    {
        $this->Log(self::DEBUG, $log);
    }

    public function LogError($log)
    {
        $this->Log(self::ERROR, $log);
    }

    public function LogNotice($log)
    {
        $this->Log(self::NOTICE, $log);
    }

    function Log($priority, $log)
    {
        if ($this->m_InitOk == false)
            return;
        if ($priority > $this->m_Priority)
            return;
        $path = $this->getLogFilePath($this->FilePath, $this->FileName).".log";
        $handle=@fopen($path,"a+");
        if ($handle === false)
        {
            return;
        }
        $datestr = strftime(" %Y-%m-%d %H:%M:%S] \n\tMsg: ");
        $caller_info = $this->get_caller_info();
        //var_dump($caller_info);
        if(!@fwrite($handle,'['.$caller_info.$datestr.$log."\n")){//写日志失败
            //echo("写入日志失败");
        }
        @fclose($handle);
        $this->RotaLog();
    }

// 1.结尾，如上例jb51;必须另起一行，否则出现错误。
// 2.定界符内的php变量一定要像这种{$a}模式，否则不会识别。

    private function get_caller_info()
    {
        $ret = debug_backtrace();//产生一条 PHP的回溯跟踪
        foreach ($ret as $item)
        {
            if(isset($item['class']) && 'Logic_logs' == $item['class'])
            {
                continue;
            }
            $file_name = basename($item['file']);
            return <<<S
Obj=>{$item['class']} act=>{$item['function']}
S;
// 定界符需要顶格，否则报错
        }
    }

    private function RotaLog()
    {
        $file_path = $this->getLogFilePath($this->FilePath, $this->FileName).".log";
        if ($this->m_LogCount%10==0)
            clearstatcache();
        ++$this->m_LogCount;
        $file_stat_info = stat($file_path);
        if ($file_stat_info === FALSE)
            return;
        if ($this->m_RotaType != 1)
            return;

        //echo "file: ".$file_path." vs ".$this->m_RotaParam."\n";
        if ($file_stat_info['size'] < $this->m_RotaParam)
            return;

        $raw_file_path = $this->getLogFilePath($this->FilePath, $this->FileName);
        $file_path = $raw_file_path.($this->m_MaxLogFileNum - 1).".log";
        //echo "lastest file:".$file_path."\n";
        if ($this->isExist($file_path))
        {
            unlink($file_path);
        }
        for ($i = $this->m_MaxLogFileNum - 2; $i >= 0; $i--)
        {
            if ($i == 0)
                $file_path = $raw_file_path.".log";
            else
                $file_path = $raw_file_path.$i.".log";

            if ($this->isExist($file_path))
            {
                $new_file_path = $raw_file_path.($i+1).".log";
                if (rename($file_path, $new_file_path) < 0)
                {
                    continue;
                }
            }
        }
    }

    private function isExist($path){
        return file_exists($path);
    }

    /**
     * @abstract 创建目录
     * @param <type> $dir 目录名
     * @return bool
     */
    private function createDir($dir){
        return is_dir($dir) or ($this->createDir(dirname($dir)) and @mkdir($dir, 0777));
    }

    /**
     * @abstract 创建日志文件
     * @param String $path
     * @return bool
     */
    private function createLogFile($path){
        $handle=@fopen($path,"w"); //创建文件
        @fclose($handle);
        return $this->isExist($path);
    }

    /**
     * @abstract 创建路径
     * @param String $dir 目录名
     * @param String $filename
     * @return unk
     */
    private function getLogFilePath($dir,$filename){
        return $dir.$filename;
    }
    const EMERG  = 0;
    const FATAL  = 0;
    const ALERT  = 100;
    const CRIT   = 200;
    const ERROR  = 300;
    const WARN   = 400;
    const NOTICE = 500;
    const INFO   = 600;
    const DEBUG  = 700;
    const TEMP_LOGS = 'log';
}