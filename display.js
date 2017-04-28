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
                getIngs(lst.baseURL, lst.nameShort);
              }
            }
    })
        .fail(function(data,status){
        });
}


var ingredients=[];
function getIngs(baseurl,nameShort){
  var url = baseurl + "ajax_listing.php";
  if(url != "ajax_listing.php"){
    $.post(url,function(data,status){
      for(var j=0;j<data.length;j++){

        var x = {name: data[j].name, short: data[j].short, unit: data[j].unit, cost: data[j].cost};
          ingredients.push(x);

      }
        fillData(ingredients,baseurl,nameShort);
    });
  }
}



var z =0;
function fillData(ings,base,nameShort){
	var details = "";
	var len = ings.length;

	for (j = z; j < len; j++) {
    var y = ings[j];
  $("#debug").append(len + " "+y.name + " "+base+" "+nameShort+"<br>");
    details = '<div class = "col-sm-3 col-md-3 col-xs-3 product-listing">';
    details += '<div class="thumbnail">';
    details += "<a href=\"food_page.php?ing="+y.name+"\">";
    details += "<img id = \""+nameShort+"_"+y.name+"\" src = \"\" alt = \"thumbnail\">";
    details += "</a>";
    details += "<div class= \"caption\">";
    details += "<h4 class = \"pull-right\">$"+y.cost+" per "+y.unit +"</h4>";
    details += "<h4><a href=\"food_page.php?ing="+y.name+"&team="+nameShort+"\">"+y.name+"</a></h4>";
    details += "<p>Site: <a href=\""+base+"\">"+base+"</a></p>";
    details += "<p>"+y.short+"</p>";
    details += "</div></div></div>";
    getImage(y,base,nameShort);
    $("#dis").append(details);
    z++;
  }
}

function getImage(ing,base,nameShort){
  var url = base + "ajax_ingrimage.php";
  $.get(url+"?ing="+ing.name,function(data){
     $("#"+nameShort+"_"+ing.name).attr('src','data:image/jpeg;base64,'+data);

  }).fail(function(){
  });
}

