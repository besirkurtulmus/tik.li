$(document).ready(function(){
    // Set the starting page to #create
    window.currentPage = '#create';

    // Play the animation after page loads
    $("#baslik").addClass('tada animated');
    setTimeout(function(){
        $("#baslik").removeClass('tada animated');
    }, 1000);

    // Make the footer static sticky
    $("#bottomNav").pinFooter();

    // Show all code on API page idented
    hljs.configure({tabReplace: '    '}); // 4 spaces
    $('pre').each(function(i, e) {hljs.highlightBlock(e)});
});

// Slide page function
function slidePage($currentpage){

    $page = $currentpage;

    $(window.currentPage).addClass("slideOutLeft animated");
    $(window.currentPage).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $(window.currentPage).removeClass("slideOutLeft animated");
        $(window.currentPage).css("display", "none");
        $($page).css("display", "block");
        $($page).addClass("slideInRight animated");
    });

    $($page).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
        $($page).removeClass("slideInRight animated");

        window.currentPage = $page;
    });
}
// Animation for showing successful key-link creation
function successLink(newLink){
    $("#create").addClass("slideOutLeft animated");
    $("#createdLink").val(newLink);
    setTimeout(function(){
        $("#create").removeClass("slideOutLeft animated");
        $("#create").css("display", "none");
        $("#create2").css("display", "block");
        $("#create2").addClass("slideInRight animated");
    }, 450);
    $("#create2").removeClass("slideInRight animated");

};

function errorLink(e) {
    // Başarısız olduğunda
        var input = $("#link_olustur");
        input.addClass('has-error');
        input.addClass('shake animated');
        setTimeout(function(){
            input.removeClass('has-error');
            input.removeClass('shake animated');
        }, 1000);
}

// Show help on #create page
$(".help").click(function(){
    if(window.currentPage == '#create'){
        $('body').chardinJs('start');
    }else{
        slidePage('#create');
        $($page).one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
            $('body').chardinJs('start');
        });
    }
});

// Change the page via page slider
$(".create, .about, .stat, .contact, .api").click(function(){
    if(window.currentPage == ('#' + this.className)){

    }else{
        slidePage('#' + this.className);
    }
    if(this.className == 'stat'){
        //Get context with jQuery - using jQuery's .get() method.
        var ctx = $("#haftaLink").get(0).getContext("2d");
        var ctx2 = $("#haftaHit").get(0).getContext("2d");
        var ctx3 = $("#saatLink").get(0).getContext("2d");
        var ctx4 = $("#saatHit").get(0).getContext("2d");
        //This will get the first returned node in the jQuery collection.
        var haftaLinkChart = new Chart(ctx);
        var haftaHitChart = new Chart(ctx2);
        var saatLinkChart = new Chart(ctx3);
        var saatHitChart = new Chart(ctx4);

        var haftaData = {
            labels : ["Pzts.","Salı","Çarş.","Perş.","Cuma","Cumt.","Pazar."],
            datasets : [
                {
                    fillColor : "rgba(151,187,205,0.5)",
                    strokeColor : "rgba(151,187,205,1)",
                    pointColor : "rgba(151,187,205,1)",
                    pointStrokeColor : "#fff",
                    data : [6500,5900,9000,8100,5600,5500,4000]
                }
            ]
        }
        var saatData = {
            labels : ["00","01","02","03","04","05","06","07","08","09","10","11","12","13","14","15","16","17","18","19","20","21","22","23"],
            datasets : [
                {
                    fillColor : "rgba(220,220,220,0.5)",
                    strokeColor : "rgba(220,220,220,1)",
                    pointColor : "rgba(220,220,220,1)",
                    pointStrokeColor : "#fff",
                    data : [2800,4800,4000,1900,9600,2700,1000,4300,2600,1700,4500,7800,2300,6500,8800,9600,1200,3600,4400,6400,2300,1200,6500,7800]
                }
            ]
        }
        var options = {
            scaleFontColor : '#ffffff',
            scaleLineColor : '#ffffff',
            scaleGridLineColor : '#e8e8e8'
        }
        haftaLinkChart.Line(haftaData, options);
        haftaHitChart.Line(haftaData, options);
        saatLinkChart.Line(saatData, options);
        saatHitChart.Line(saatData, options);
    }
});

// When user clicks the create button
$('#yarat').click(function(){

    formData = {
        "l":$("#newLink").val()
    }

    $.ajax({
        url : "./api.php",
        type : "POST",
        dataType : "json",
        data : JSON.stringify(formData),
        success : function(data){
            answer = $.parseJSON(data)

            if(answer['status'] == 'success'){
                successLink(answer['key']);
            }else{
                alert('Invalid request!')
            }
        },
        error : function(dat){
            errorLink();
        }
    });
});