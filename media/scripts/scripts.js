function addLink() {
    $.post("/links/addlink", {url: $("#url").val(), name: $("#name").val()}, function(name) {
        if (name == 'false') {
            $("#message").fadeIn();
        } else {
            $("#addlink").html("Your link has been added. Go to: <a href='/" + name + "'>http://picopath.com/" + name + "</a>");
        }
    });
}

function checkLink() {
    $.get("/links/getlink/"+$("#name").val(), function (taken){
        if (taken === 'true') {
            $('#taken').html("That name is already taken");
        }else{
            $('#taken').html('Available!');
        }
        
    });
}