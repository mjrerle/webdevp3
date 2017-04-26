$(document).ready(function() {
	var jqxhr = $.post("https://www.cs.colostate.edu/~ct310/yr2017sp/more_assignments/project03masterlist.php", function(data, status) {
		parseData(data);
		$("#masterstatus").html("master: "+status);
	})
    .fail(function(){
            $("#masterstatus").html("Failed to open");
            $("#masterstatus").css("background-color", "red");
        })
});

var ingredients=[];
function parseData(lst) {
	var rt = "";
	var tab = document.getElementById("ingredients");
	var len = lst.length;
	for (j = len - 1; j >= 0; j--) {
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

function getIngs(baseurl){
  var url = baseurl + "ajax_listing.php";
  if(url != "ajax_listing.php"){
    $.post(url,function(data,status){
      $("#debug").append();

      ingredients.push(data);
      fillData(ingredients,baseurl);
  });
  }
}

function fillData(ings,base){
	var rt = "";
	var tab = document.getElementById("ingredients");
	var i = tab.rows.length;
	var len = ings.length;
	for (j = 0; j < len; j++) {
    var y = ings[j];
		rt  = "<tr><td class = \"" +y[j].name+"row\" id=\"" + y[j].name + "_row\" style=\"padding: 1%\">";
		rt += "<a href=\"" + base + "\">" + y[j].name + "</a>";
		rt += "</td>";
        rt += "<td>"+y[j].short+"</td>";
        rt += "<td>"+y[j].unit+"</td>";
        rt += "<td>"+y[j].cost+"</td>";
		rt += "</tr>";
		var rr = tab.insertRow(i);
		rr.innerHTML = rt;
  }
}


