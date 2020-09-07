@extends('layouts.default.show',['page'=>'History For '. $product->name,'route_name'=>'history',
                                'name_entity'=>'History','btnAction'=>false,
                                'columns'=>$columns_history,'entities'=>$histories])