<?php

namespace DevWorkout\Bothound\Console\Commands;

use DevWorkout\Bothound\Models\BothoundIp;
use Illuminate\Console\Command;

class Optimize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bothound:optimize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize known bot IPs into subnets';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->optimizeKnownBotIps();
    }

    private function optimizeKnownBotIps()
    {
        $this->line( 'Optimizing Known bot IPs' );

        BothoundIp::chunk( 1000, function ( $ips )
        {
            $this->line( 'Processing chunk' );
            $ips->mapToGroups( function ( $v )
            {
                return [ $v->subnet() => $v->ip ];
            } )
                ->filter( function ( $ips )
                {
                    return $ips->count() > 1;
                } )
                ->each( function ( $ips, $subnet )
                {
                    BothoundIp::where( 'ip', 'like', $subnet . '%' )->delete();
                    BothoundIp::create( [ 'ip' => $subnet . '.*' ] );
                    $this->line( 'Known IPs (' . $ips->implode( ',' ) . ') optimized into subnet ' . $subnet );
                } )
                /**//**/
            ;

        } );

    }

}