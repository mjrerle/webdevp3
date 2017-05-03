var ing = getUrlVars()["ing"];
var team = getUrlVars()["team"];

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
    vars[key] = value;
    });
return vars;
}

$(document).ready(function() {
	var jqxhr = $.post("https://www.cs.colostate.edu/~ct310/yr2017sp/more_assignments/project03masterlist.php", function(data, status) {
        $("#masterstatus").html("master status open " + ing + " " + team);
		findShortName(data, ing, team);

	})
    .fail(function(){
            $("#masterstatus").html("Failed to open");
            $("#masterstatus").css("background-color", "red");
        })
});


function findShortName(lst, ing, team) {
	var len = lst.length;
	for (j = len - 1; j >= 0; j--) {
        if(lst[j].nameShort == team){
            getInfo(lst[j].baseURL, ing);
            getImage(lst[j].baseURL, ing);
        }
    }
}

function getInfo(baseURL,ing){
    jQuery.post(baseURL + "ajax_ingredient.php?ing="+ing, function(data, status) {
        jQuery(".name").html(data.name);
        jQuery(".price").html(data.cost);
        jQuery(".unit").html(data.unit);
        jQuery(".desc").html(data.desc);
        var cart = "<a href=\"cart.php?name="+data.name+"&team="+baseURL+"&cost="+data.cost+"\">Add to cart</a>";
        $("#cart").html(cart);
    });
}

function getImage(baseURL, ing){
    jQuery.get(baseURL + "ajax_ingrimage.php?ing="+ing, function(data, status) {
        jQuery('#product_image').attr('src', 'data:image/jpg;base64,' + data);
    }).fail(function(){
    });
}
