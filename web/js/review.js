var positive_words = "";
var negative_words = "";


$( document ).ready(function() {

    //This will load the reviews, and with positive_words & negative_words will finally print the result.
    $("#reviews").change(function(e) {
        if (positive_words != "" || negative_words !=""){
        $("#error").html("");
        var ext = $("input#reviews").val().split(".").pop().toLowerCase();

        if($.inArray(ext, ["csv"]) == -1) {
            $("#error").html("Wrong file :-(");
            return false;
        }

        if (e.target.files != undefined) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var csvval=e.target.result;

                var result = $.csv.toObjects(csvval);

                var hotels =[];
                $.each( result, function( key, value ) {

                    var tdHotelId;
                    var tdReviewId;

                    var tdReview;
                    var badDesc = "-"
                    var goodDesc = "-"
                    var score = 0;

                    $.each( value, function( header, value ) {
                        if (header == "HotelId"){
                            tdHotelId = value;
                        }

                        if (header == "ReviewId"){
                            tdReviewId = value
                        }


                        if (header == "Review"){
                            tdReview = value
                            var neg = 0;
                            var pos = 0;

                            var listOfPositiveWords = positive_words.split(",").join('|');
                            var regexGood = new RegExp("\\b" + listOfPositiveWords + "\\b", "g");

                            var posRegObj = value.match(regexGood);

                            if (posRegObj != null){
                                pos = posRegObj.length;
                                goodDesc = posRegObj.join();
                            }

                            var listOfNegativeWords = negative_words.split(",").join('|');
                            var regexBad = new RegExp("\\b" + listOfNegativeWords + "\\b", "g");


                            var negRegObj = value.match(regexBad);
                            if (negRegObj != null){
                                neg = negRegObj.length;
                                badDesc = negRegObj.join();
                            }
                            score = pos - neg;

                        }

                        if (tdReview != undefined){
                            var html = "<ul><li><b>Hotel id:</b> "+tdHotelId+"</li><li><b>Review:</b> "+tdReview+" </li><li><b>Positive:</b> "+goodDesc+"</li><li><b>Negative:</b> "+badDesc+"</li><li><b>Score:</b> "+score+"</li></ul>"
                            $('#bodyReviews').append(html);
                        }

                    });
                });
            };
            reader.readAsText(e.target.files.item(0));

        }

        return false;
        }else{
            $("#error").html("Please load first the criteria file");
        }
    });



    //This will process the criteria and then will set to the global positive and negative vars the values.
    $("#criteria").change(function(e) {
        $("#error").html("");
        var ext = $("input#criteria").val().split(".").pop().toLowerCase();

        if($.inArray(ext, ["csv"]) == -1) {
            $("#error").html("Wrong file :-(");
            return false;
        }

        if (e.target.files != undefined) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var csvval=e.target.result;

                var result = $.csv.toObjects(csvval);

                $.each( result, function( nothing, value ) {
                    $.each( value, function( header, adjective ) {

                        if (header=="Positives"){
                            if (adjective != "" && adjective){
                                positive_words = positive_words + adjective.trim() + ','
                            }
                        }

                        if (header=="Negatives"){
                            if (adjective != ""){
                                negative_words = negative_words + adjective.trim() + ','
                            }
                        }

                    });
                });

                positive_words = positive_words.substring(0, positive_words.length - 1);
                negative_words = negative_words.substring(0, negative_words.length - 1);

            };
            reader.readAsText(e.target.files.item(0));

        }

        return false;

    });

    //This will upload the reviews via AJAX
    $( "#upload_form" ).submit(function( event ) {
        if($('#form_ajax').is(':checked')) {
            if (isCsv($('#form_reviews').val())){

                event.preventDefault();
                $.ajax({
                    url: '/load-manual-ajax/',
                    type: 'POST',
                    dataType: "html",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function (data, status) {
                        var parsed = $.parseHTML(data);
                        $(parsed).find("#reviews-container");
                        $("#formcont").html(parsed);
                        runDataTable();
                    },
                    error: function (xhr, desc, err) {
                        $("#error").html(desc);
                    }
                });
            }else{
                $("#error").html("Wrong file :-(");
            }
            return false;
        }

    });


    //This function will check the live review
    $( "#checkReview" ).click(function() {
        var neg = 0;
        var pos = 0;
        var review=$('#review').val();

        neg = adjectivesFound(review,$('#negative_words').val().trim());
        pos = adjectivesFound(review,$('#positive_words').val().trim());

        var score = pos - neg;

        var scoreText;
        if (score == 0){
            scoreText = "Score is "+score+" :-|";
        } else if (score > 0) {
            scoreText = "Score is "+score+" :-D";
        }else{
            scoreText = "Score is "+score+" :-(";
        }
        $('#live-review-score').html(scoreText);
    });

    //Set the live review form back to the initial state
    $( "#resetReview" ).click(function() {
        $('#review').val("");
        $('#negative_words').val("");
        $('#positive_words').val("");
        $('#live-review-score').html("Write your review and check if it's positive or not against your positive and negative words");

    });

});

//This will return a number of adjectives found in a review
function adjectivesFound(review,adjectives){

    var found = 0;

    if (adjectives != "") {

        var listOfWords = adjectives.split(",").join('|');
        var regex = new RegExp("\\b" + listOfWords + "\\b", "g");

        var regexObj = review.match(regex);
        if (regexObj != null) {
            found = regexObj.length;
        }
    }
    return found;
}


function runDataTable(){
    var table =$('#reviews-container').DataTable();

    if (table != undefined){
        $('#reviews-container tfoot th').each( function () {
            var title = $('#reviews-container tfoot th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" id="search-field-'+title.replace(/ /g,'')+'" placeholder="Search '+title+'" />' );
        } );

        table.columns().eq( 0 ).each( function ( colIdx ) {
            $( 'input', table.column( colIdx ).footer() ).on( 'keyup change', function () {
                table
                    .column( colIdx )
                    .search( this.value )
                    .draw();
            } );
        } );
    }
}