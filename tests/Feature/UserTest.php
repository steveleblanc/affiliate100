<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testUrl()
    {
        $response = $this->get('/');
        $response->assertSee('The following Affiliates');
        $response->assertStatus(200);
    }

    public function testFilePath()
    {
        $this->assertFileExists(storage_path('app/public/affiliates.txt'));
    }

    public function testDistanceInvited()
    {
        // "latitude": "53.2451022", "affiliate_id": 4, "name": "Inez Blair", "longitude": "-6.238335"
        $officeLatitude = 53.3340285;
        $officeLongitude = -6.2535495;
        $unit = 'kilometers';
        $theta = $officeLongitude - -6.238335; 
        $distance = (sin(deg2rad($officeLatitude)) * sin(deg2rad(53.2451022))) + (cos(deg2rad($officeLatitude)) * cos(deg2rad(53.2451022)) * cos(deg2rad($theta))); 
        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515; 
          switch($unit) { 
          case 'miles': 
          break; 
          case 'kilometers' : 
          $distance = $distance * 1.609344; 
        } 
        $theDistance = (round($distance,1));
        $this->assertLessThanOrEqual(100, $theDistance);
    }

    public function testDistanceNotInvited()
    {
        // "latitude": "51.92893", "affiliate_id": 1, "name": "Lance Keith", "longitude": "-10.27699"
        $officeLatitude = 53.3340285;
        $officeLongitude = -6.2535495;
        $unit = 'kilometers';
        $theta = $officeLongitude - -10.27699; 
        $distance = (sin(deg2rad($officeLatitude)) * sin(deg2rad(51.92893))) + (cos(deg2rad($officeLatitude)) * cos(deg2rad(51.92893)) * cos(deg2rad($theta))); 
        $distance = acos($distance); 
        $distance = rad2deg($distance); 
        $distance = $distance * 60 * 1.1515; 
          switch($unit) { 
          case 'miles': 
          break; 
          case 'kilometers' : 
          $distance = $distance * 1.609344; 
        } 
        $theDistance = (round($distance,1));
        $this->assertGreaterThanOrEqual(100, $theDistance);
    }

}
