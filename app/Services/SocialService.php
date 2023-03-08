<?php
namespace App\Services;

use Illuminate\Support\Arr;
use App\Models\Social;

/**
 * Class SocialService
 * @package App\Services
 */
class SocialService
{
    public function getAllSnsData() {
        return Social::get();
    }
}
