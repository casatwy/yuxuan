<?php 
$xhprof_root = "/var/www/xhprof/xhprof";

require_once $xhprof_root."/xhprof_lib/utils/xhprof_lib.php";
require_once $xhprof_root."/xhprof_lib/utils/xhprof_runs.php";

class Xhprof
{
    public static function xhprofRun($data,$name){
        $xhprof_run = new XHprofRuns_Default();
        $run_id = $xhprof_run->save_run($data,$name);
        return $run_id;
    }
}
?>
