$(document).ready(function() {
	var jqxhr = $.post("https://www.cs.colostate.edu/~ct310/yr2017sp/more_assignments/project03masterlist.php", function(data, status) {
		parseData(data);
	})
    .fail(function(){
            $("#masterstatus").html("Failed to open");
            $("#masterstatus").css("background-color", "red");
        })
});

function parseData(lst) {
	var rt = "";
	var tab = document.getElementById("ingredients");
	var len = lst.length;
	for (j = 0; j < len; j++) {
        getStatus(lst[j]);//call in initial loop else there be dragons!
    }
}

function getStatus(lst){
    var url = lst.baseURL;
    url = url + "ajax_status.php";

    jQuery.post(url,function(data,status){
            if(typeof data.status !== undefined){
              if(data.status == "open"){
                getIngs(lst.baseURL);
              }
            }
    })
        .fail(function(data,status){
        });
}


var ingredients=[];
function getIngs(baseurl){
  var url = baseurl + "ajax_listing.php";
  if(url != "ajax_listing.php"){
    $.post(url,function(data,status){
      for(var j=0;j<data.length;j++){

        var x = {name: data[j].name, short: data[j].short, unit: data[j].unit, cost: data[j].cost};
        if(!uniq(ingredients,x)){
          ingredients.push(x);
        }

      }
        fillData(ingredients,baseurl);
    });
  }
}

function uniq(ings, u){
  var b = false;
  var j = u.name;
  for(var t in ings){
    if(j == ings[t].name){
      b = true;
    }
  }
  return b;
}

var z =0;
function fillData(ings,base){
	var details = "";
	var len = ings.length;

	for (j = z; j < len; j++) {
    var y = ings[j];
  //  $("#debug").append(len + " "+y.name + " "+base+"<br>");
    details = '<div class = "col-sm-3 col-md-3 col-xs-3 product-listing">';
    details += '<div class="thumbnail">';
    details += "<a href=\"food_page.php?ing="+y.name+"\">";
    details += "<img id = \"_"+y.name+"\" src = \"\" alt = \"thumbnail\">";
    details += "</a>";
    details += "<div class= \"caption\">";
    details += "<h4 class = \"pull-right\">$"+y.cost+" per "+y.unit +"</h4>";
    details += "<h4><a href=\"food_page.php?ing="+y.name+"\">"+y.name+"</a></h4>";
    details += "<p>"+y.short+"</p>";
    details += "</div></div></div>";
    getImage(y,base);
    $("#dis").append(details);
    z++;
  }
}

function getImage(ing,base){
  var url = base + "ajax_ingrimage.php";
  $.get(url+"?ing="+ing.name,function(data){
     $("#_"+ing.name).attr('src','data:image/jpeg;base64,'+data);

  }).fail(function(){
  });
}

