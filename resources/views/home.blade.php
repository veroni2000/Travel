@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Open+Sans|Vollkorn" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=BenchNine|Bree+Serif|Open+Sans|Vollkorn" rel="stylesheet">
<style type="text/css">
    body > table:nth-child(5) > tbody > tr:nth-child(1) , body > table:nth-child(7) > tbody > tr:nth-child(1){display: none;}
</style>
</head>
<body style="font-family:'Bree Serif', serif;">
<a href="{{ URL::route('moreinfo') }}" class="btn btn-default"> More Info </a>
<form action="{{route('get_flights')}}" method="GET">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="form-group" style="display: inline-block;" >
        <h3>Start Point</h3>
        <select class="form-control" name="start_id" class="dropdown-menu" style="width: 100%">
            @foreach($sflights as $sflight)
                <option value="{{$sflight->start_id}}" class="dropdown-item">{{$sflight->city_start}}</option>
             @endforeach
        </select>
    </div>
    <div style='display: inline-block;'>
        <h3>End Point</h3><select class="form-control" name="end_id" class="dropdown-menu" style="width: 100%">
            @foreach($eflights as $eflight)
                <option value="{{$eflight->end_id}}">{{$eflight->city_end}}</option>
             @endforeach
        </select>
    </div>

    <input type="submit" name="find" value="Find" class="btn btn-info" style="margin-left: 3%">
    </form>
    <?php
    if(isset($_GET['find']))
    {
        if($start_city_id == $end_city_id)
            echo "<h3>Choose different destinations.</h3>";
        else
        {
            echo "<h3>DIRECT FLIGHTS</h3>";
            echo "<table class='table table-bordered table-hover'>";
            echo '<thead class="text-danger">
                <tr>
                    <th scope="col" colspan="2" class="text-center">FLIGHT</th>
                    <th scope="col" class="text-center">PRICE</th>
                </tr>
            </thead>';
            // part one direct flight
            if(!empty($direct_flight))
            {
                echo "<td>".$direct_flight->city_start."</td>";
                echo "<td>".$direct_flight->city_end."</td>";
                echo "<td>".$direct_flight->price." lv.</td>";
                
            }
            
            else
                echo "<td class='text-center'>There is no such direct flight.</td>";
            echo "</table>";


            //part two with one transfer __START___
            ?>


            <h3> FLIGHTS WITH ONE TRANSFER: </h3>
            <table class='table table-bordered table-hover'>
            <thead class="text-danger">
                <tr>
                    <!-- <th>#</th> -->
                    <th colspan="2" class="text-center">FIRST FLIGHT</th>
                    <th colspan="2" class="text-center">SECOND FLIGHT</th>
                    <th class="text-center">PRICE</th>
                </tr>
            </thead>
            <?php

            foreach ($one_city_transfer as $flights) 
            {

                ?>
                <tr>
                <?php
                $id = 0;
                $price='';
                foreach ($flights as $flight) 
                {

                    echo "<td>".$flight->city_start."</td>";
                    echo "<td>".$flight->city_end."</td>";
                    $price+=$flight->price;
                    
                    
                    
                }
                $price/=3;
                echo "<td>".round($price, 2)." lv.</td>";
                ?>
                </tr>
                <?php
            }
            ?>
            </table>
            <h3> FLIGHTS WITH TWO TRANSFERS </h3>
            <table class='table table-bordered table-hover'>
            <thead class="text-danger">
                <tr>
                    <th colspan="2" class="text-center">FIRST FLIGHT</th>
                    <th colspan="2" class="text-center">SECOND FLIGHT</th>
                    <th colspan="2" class="text-center">THIRD FLIGHT</th>
                    <th class="text-center">PRICE</th>
                </tr>
            </thead>
            <?php
            //part two with one transfer __END___
            /*echo "<pre>";
            var_dump($two_cities_transfer);
            echo "</pre>";*/
            //part three with two transfer ___START___
            foreach ($two_cities_transfer as $flights) 
            { $price='';
        echo "<tr>";
        
                foreach ($flights as $flight) 
                {
                    
                    echo "<td>".$flight->city_start."</td>";
                    echo "<td>".$flight->city_end."</td>";
                    $price+=$flight->price;
                    
                }
                $price/=4;
                echo "<td>".round($price, 2)." lv.</td>";
                echo "</tr>";
            }
            //part three with two transfer ___END___

        }
    }
    ?>
    </table>
@endsection
