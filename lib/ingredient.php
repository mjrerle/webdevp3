<?php
  class Ingredient{
    public $name;
    public $unit;
    public $id;
    public $price;
    public $description;
    public $longdescription;
    public $time;
    public $imgURL;

    function __construct($name="",$unit="",$id=0,$description="", $longdescription="",$time="",$price=0, $imgURL =""){
      $this->name = $name;
      $this->unit = $unit;
      $this->id = $id;
      $this->description=$description;
      $this->price=$price;
      $this->longdescription=$longdescription;
      $this->time=$time;
      $this->imgURL=$imgURL;
    }
    public static function getIngredientFromRow($row){
      $ingredient = new Ingredient();
      $ingredient->name = $row['i_name'];
      $ingredient->unit = $row['unit'];
      $ingredient->id = $row['id'];
      $ingredient->price = $row['price'];
      $ingredient->description = $row['description'];
      $ingredient->longdescription=$row['longdescription'];
      $ingredient->time=$row['time'];
      $ingredient->imgURL = $row['imgURL'];
      return $ingredient;
    }
    function __toString(){
      return $this->name;
    }
  }
