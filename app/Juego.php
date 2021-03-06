<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{

    /*
     * Deben asignarse nombre_server => nombre_imagen
     *
     * La imagen debe ser 1280*500
     * */
    const featured =[
        'juego1'=>'zombieFeat.jpg',
        'juego2'=>'pongFeat.jpg',
        'juego3'=>'puzzleFeat.jpg'
    ];
    public $featImage;

    public static function getFeaturedGames()
    {
        $feat = [];
        foreach (self::featured as $nombre=>$img){
            $game = self::where('nombre_server',$nombre)->first();
            if($game!=null){
                $game->featImage = $img;
                array_push($feat,$game);
            }
        }
        return $feat;
    }

    public static function getHotGames()
    {
        return self::orderBy('valoracion_promedio','desc')->limit(9)->get();
    }

    public static function getIniciales()
    {
        return self::orderBy('fecha_creacion','desc')->limit(9)->get();
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function creador(){
        return $this->belongsTo('App\Creador');
    }

    public function comentarios(){
        return $this->hasMany('App\Comentario');
    }

    public function valoracions(){
        return $this->belongsToMany('App\User','valoracions')
            ->withPivot('juego_id','usuario_id','estrellas');
    }

    public function toArray()
    {
        $arr= parent::toArray();
        $tags= $this->tags()->toArray();
        $arr['tags']=$tags;
        return $arr;
    }

}
