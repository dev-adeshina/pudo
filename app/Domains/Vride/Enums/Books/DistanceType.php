<?php 


namespace App\Domains\Vride\Enums\Books;

enum DistanceType: string 
{
    case TRAVEL = 'travel';
    case SHORT_TRIP = 'short_trip';
    case LONG_TRIP = 'long_trip';

}