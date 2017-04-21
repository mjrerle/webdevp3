jQuery(document).ready(function() {
	var jqxhr = jQuery.post("https://www.cs.colostate.edu/~ct310/yr2017sp/more_assignments/project03masterlist.php", function(data, status) {
		addRows(data);
		jQuery("#masterStatus").html(status);
        jQuery("#masterStatus").css("background-color", "green");
	})
    .fail(function(){
            jQuery("#masterStatus").html("Failed to open");
            jQuery("#masterStatus").css("background-color", "red");
        })
});


function addRows(lst) {
	var rt = "";
	var tab = document.getElementById("teams");
	var i = tab.rows.length;
	var len = lst.length;
	for (j = len - 1; j >= 0; j--) {
        
		rt  = "<tr><td class = \"" +lst[j].Team+"row\" id=\"" + lst[j].Team + "_row\" style=\"padding: 1%\">";
		rt += "<a href=\"" + lst[j].baseURL + "\">" + lst[j].nameLong + "</a>";
		rt += "</td>";
        rt += "<td class = \"" +lst[j].Team+"row\" id=\"" + lst[j].Team + "_sn\" style=\"padding: 1%\">"+lst[j].nameShort+"</td>";
		rt += "<td class = \"" +lst[j].Team+"row\" id=\"" + lst[j].Team + "_status\" style=\"padding: 1%\">...</td></tr>";
		var rr = tab.insertRow(i);
		rr.innerHTML = rt;
        getStatus(lst[j]);//call in initial loop else there be dragons!
    }
}

function getStatus(lst){
    var url = lst.baseURL;
    var t = lst.Team;
    var nl = lst.nameLong;
    var ns = lst.nameShort;
    var rowClass = "." + t + "row"; //t used for id and class due to groups using & in names, & is not a valid char in id's
    var snCol = "#" + t + "_sn";
    var statCol = "#" + t + "_status";
    url = url + "ajax_status.php";
        
    jQuery.post(url,'json/text')
        .done(function(data, status){
            
            if(data.status == "closed" || data.status == "open" || data.status==""){
                getStatusColor(rowClass, data.status);
                jQuery(statCol).html(data.status + ": encoded without an array");
            }
            else if (data[0].status == "closed" || data[0].status == "open" || data[0].status == ""){
                getStatusColor(rowClass, data[0].status);        
                jQuery(statCol).html(data[0].status);
            }
            
            else{
               // getStatusColor(rowClass, data);        
                jQuery(rowClass).css("background-color", "yellow"); //override getStatusColor due to improper encoding of data.
                jQuery(statCol).html(data + ": Improper Encoding");
            }
            
        }) //close .done
        
        .fail(function(){
            jQuery(statCol).html("Failed to open: " + url+ " Path doesn't exist");
            jQuery(rowClass).css("background-color", "yellow");//override getStatusColor due to no data.
        });
    
}


function getStatusColor(rowClass,  statData) {
	jQuery.post("statusColor.php", {a : statData}, function(data, status) {
        jQuery(rowClass).css("background-color", data);
	})
}
