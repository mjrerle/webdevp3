var burl;
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
    burl = url;
    url = url + "ajax_status.php";

    jQuery.post(url,function(data,status){
            if(typeof data[0].status !== undefined){
              if(data[0].status == "open"){
                getIngs(lst.baseURL);
              }
            }
    })
        .fail(function(data,status){
        });
}

function getIngs(baseurl){
  var url = baseurl + "ajax_listing.php";
  $.post(url,function(data,status){
        var x = JSON.parse(data);
        ingredients.push(x);
        fillData(ingredients,baseurl);
    });
}

function fillData(ings,base){
	var rt = "";
	var tab = document.getElementById("ingredients");
	var i = tab.rows.length;
  ings = Array.from(new Set(ings));
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


