<?php


/* Pass in by reference! */
function graph_requests_report ( &$rrdtool_graph ) {

   global $context, 
           $cpu_nice_color,  
           $cpu_user_color,
           $hostname,
           $range,
           $rrd_dir,
           $size;

    $title = 'Kafka Requests';
    if ($context != 'host') {
       $rrdtool_graph['title'] = $title;
    } else {
       $rrdtool_graph['title'] = shortenFQDN($hostname) . " $title last $range";

    }

    $rrdtool_graph['lower-limit']    = '0';
    $rrdtool_graph['vertical-label'] = 'requests/msec';
    $rrdtool_graph['extras']         = '--rigid';
 
    if($context != "host" )
                {
                    $rrdtool_graph['series'] ="DEF:'produced'='${rrd_dir}/Kafka.ProduceRequestsPerSecond.rrd':'sum':AVERAGE "
                   ."DEF:'consumed'='${rrd_dir}/Kafka.FetchRequestsPerSecond.rrd':'sum':AVERAGE "
                   ."AREA:'consumed'#$cpu_user_color:'Consumed' "
                   ."STACK:'produced'#$cpu_nice_color:'Produced' "
                }

return $rrdtool_graph;
}


?>
