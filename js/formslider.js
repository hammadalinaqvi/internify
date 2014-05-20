$(document).ready(function(){
  $("form#employer1").submit(function(e) {
    e.preventDefault();
  });
   $("form#employer2").submit(function(e) {
    e.preventDefault();
  });
   $("form#employer3").submit(function(e) {
    e.preventDefault();
  });
   $("form#intern").submit(function(e) {
    e.preventDefault();
  });
  $("form#loginForm").submit(function(e) {
    e.preventDefault();
  });
  
  var cintern1 = $("#intern-step1");
  var cemployer1 = $("#employer-step1");
  var cemployer2 = $("#employer-step2");
  var cemployer3 = $("#employer-step3"); 
  
  /* display the intern step 1 */
  $("#showintern").on("click", function(e){
    e.preventDefault();
    var newheight = cintern1.height();
	
    $(cintern1).css("display", "block");
    
    $(cintern1).stop().animate({
      "left": "0px"
    }, 500, function() { /* callback */ });
    $(cemployer1).stop().animate({
      "left": "880px"
    }, 0, function() { $(cemployer1).css("display", "none"); $(cemployer2).css("display", "none"); $(cemployer3).css("display", "none"); });
    
    $("#page").stop().animate({
      "height": newheight+"px"
    }, 550, function(){ /* callback */ });
  });
  
  /* display the employer step 1 */
  $("#showemployer").on("click", function(e){
	  $(cemployer2).css("display", "none");
	  $(cemployer3).css("display", "none");
    e.preventDefault();
	
	
    var newheight = cemployer1.height();
	//alert(newheight);
    $(cemployer1).css("display", "block");
    
    $(cintern1).stop().animate({
      "left": "-880px"
    }, 500, function(){ /* callback */ });
    
    $(cemployer1).stop().animate({
      "left": "0px"
    }, 500, function(){ $(cintern1).css("display", "none"); });
    
    $("#page").stop().animate({
      "height": newheight+"px"
    }, 550, function(){ /* callback */ });
  });
 
 
  /* display the employer step 2 */
  $("#showemployer2").on("click", function(e){
   // e.preventDefault();
 
   if($('#daterange').val() && $('#post_title').val() && $('#post_description').val())
   {
 		//var newheight = cemployer2.height();
		var newheight = 600;
		$(cemployer2).css("display", "block");
		
		$(cemployer1).stop().animate({
		  "left": "-880px"
		}, 500, function() { /* callback */ });
		$(cemployer2).stop().animate({
		  "left": "0px"
		}, 500, function() { $(cemployer1).css("display", "none"); });
		
		$("#page").stop().animate({
		  "height": newheight+"px"
		}, 550, function(){ /* callback */ });
   }
  });
  
  /* display the employer step 3 */
  $("#showemployer3").on("click", function(e){
   // e.preventDefault();
  // alert($('input[name="hidden-skilltags"]').val());
   	if($('input[name="hidden-skilltags"]').val()=='')
		{
			var skills = new LiveValidation('skills',  {onlyOnSubmit: true });
			skills.add(Validate.Presence,{ failureMessage: 'Required' });	
		}else
		{
			var skills = new LiveValidation('skills',  {onlyOnSubmit: true });
			skills.remove(Validate.Presence,{ failureMessage: 'Required' });	
		}
   
	
	 if($('#industries2').val() && $('input[name="hidden-skilltags"]').val())
   {
	   //alert($('#post_title').val());
	 
	   $('#internship_title').html($('#post_title').val());
    var newheight = cemployer3.height();
    $(cemployer3).css("display", "block");
    
    $(cemployer2).stop().animate({
      "left": "-880px"
    }, 500, function() { /* callback */ });
    $(cemployer3).stop().animate({
      "left": "0px"
    }, 500, function() { $(cemployer2).css("display", "none"); });
    
    $("#page").stop().animate({
      "height": newheight+"px"
    }, 550, function(){ /* callback */ });
   }
  });
 
  
});