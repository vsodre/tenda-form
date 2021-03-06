<?php namespace App\Http\Controllers;

use Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ImageBuilder;
use App\Config;

class Photo extends Controller {
    private $ib;

    public function __construct(ImageBuilder $ib){
        $this->ib = $ib;
    }

    public function postPrintPhoto(Request $req){
        $conf = Config::find('Camera');
        if($req->hasFile('photo')){
            $this->ib->paste($conf->frame_path, 0, 0,1);
            $this->ib->paste($_FILES["photo"]["tmp_name"], $conf->hpad, $conf->vpad, $conf->rfactor/100);
            $img = '/tmp/' . uniqid() . '.png';
            $this->ib->save($img);
            system('lpr ' . $img);
            return response()->json(["ok"=>1]);
        } else {
            return response()->json(["ok"=>0]);
        }
    }

    public function postPreviewPhoto(Request $req){
        $q = Config::find('Camera');
        $this->ib->paste($q->frame_path, 0, 0,1);
        $this->ib->paste(public_path('/img/placeholder.png'), $req->input('hpad'), $req->input('vpad'), $req->input('rfactor')/100);
        $this->ib->output();
    }

}
