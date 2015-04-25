$(document).ready(function(){


  var clicknum = 0;
  $(".mobile-menu.trigger").on("click",function(){
    if(clicknum==0)
      {
        $('.nav.mobile').css("margin","0"); 
        clicknum = 1;
      }
    else 
      { 
        $('.nav.mobile').css("margin",""); 
        clicknum = 0;
      }
  });

  var clicknum2 = 0;
  $(".track_list").on("click",function(){
    if(clicknum2==0)
      {
        $(this).trigger("mouseenter"); 
        clicknum2 = 1;
      }
    else 
      { 
        $(this).trigger("mouseleave"); 
        clicknum2 = 0;
      }
  });

	/*Login Check*/
        $("#login").click(function(e){
        	e.preventDefault();
           $.post("login",{username:$("#username").val(),password:$("#password").val()},function(data){
               try{
              var newobj=JSON.parse(data);
             if(newobj.status){
                $(".results").html("<p>Login Successfully</p>");
                setTimeout(function(){ window.location.href="posts.php"; }, 1000);
             }else{
                 
                       $(".results").html("<p>Username / Password is wrong</p>");
             
             }
             }catch(err){
             $(".results").html("Some internal error occured");
             }
           });
        });
        /*edit*/
        $(document).on("click","#edit",function(e){
        	jQuery(".add_post").removeClass("add_post");
        	jQuery("#hd_but").text("Update");
        	jQuery("#form_val").val("update");
        	jQuery("#hd_but").addClass("update");
        	$(".image_fields").remove();
        	e.preventDefault();
            jQuery("#hidden_form").show();
            var id=$(this).attr("href");
            $("#form_id").val(id);
            $.post("edit",{id:id,edit:"edit"},function(data){
			try{
              var newobj=JSON.parse(data);
             jQuery("#title").val(newobj.title);
               jQuery("#desc").val(newobj.desc);
               jQuery("#author").val(newobj.author);
               if(newobj.image!="")
               $("<div class='img_out'><img src='upload_images/"+newobj.image+"' alt='no-image'><button name='del' id='del' type='button'>Delete</button><input type='hidden' value='upload_images/"+newobj.image+"' name='old_image' id='old_image'/></div>").insertAfter( "#hidden_form #desc" );
           		else
           		$("<div class='image_fields'><input id='image_file' type='file' name='image_file'/></div>").insertAfter( "#hidden_form #desc" );	
             }catch(err){
             $(".results_add").html("Some internal error occured");
             }
            });
        });
/*delete image*/ 
$(document).on("click","#del",function(e){
var r = confirm("Are you sure?");
if(r){
	var old_image=jQuery("#old_image").val();
	$(".img_out").remove();

	$("<div class='image_fields'><input id='image_file' type='file' name='image_file'/><input type='hidden' value='"+old_image+"' name='old_image' id='old_image'/></div>").insertAfter( "#hidden_form #desc" );
}
});
        /*Add Post*/
        $(document).on("click","#add_post",function(e){
        	jQuery("#hidden_form input").val("");
        	jQuery("#hidden_form textarea").val("");
        	jQuery("#hd_but").text("Add");
        	jQuery("#form_val").val("add");
        	$(".image_fields").remove();
        	$("<div class='image_fields'><label>Image</label><input id='image_file' type='file' name='image_file'/></div>").insertAfter( "#hidden_form #desc" );
        	$(".img_out").remove();
        	jQuery(".update").removeClass("update");
        	jQuery("#hd_but").addClass("add_post");
        	e.preventDefault();
            jQuery("#hidden_form").show();
        });
        /*Cancel*/
        $(document).on("click","#hd_cancel",function(e){
        	e.preventDefault();
            jQuery("#hidden_form").hide();
        });
        /*Update Data*/
         $(document).on("click",".update",function(e){
         	jQuery(".add").removeClass("add");
        	e.preventDefault();
        	var add=$('#image_file').length;
        	if(jQuery("#author").val()!="" && jQuery("#desc").val()!="" && jQuery("#title").val()!=""){
        		if(image_check(jQuery("#image_file").val())==1||add<=0){
                 var r = confirm("Update post?");
            if(r){
            		$form_data=new FormData($('#hidden_form')[0]);
			$.ajax({
    url : "edit",
    type: "POST",
    data : $form_data,
    processData: false,
    contentType: false,
    success:function(data, textStatus, jqXHR){
            try{
              var newobj=JSON.parse(data);
             if(newobj.result!="Not updated"){
               alert(newobj.result);
               window.location.href="posts.php";
                     }else{
                        alert(newobj.result);
                     }
             }catch(err){
             alert("Some internal error occured");
             }
    },
    error: function(jqXHR, textStatus, errorThrown){
        alert("Some internal error occured");
    }
});
			
          }
      }}else{
      	alert("enter fields");
      }
        });
         /*Add new post*/
         $(document).on("click",".add_post",function(e){
         	jQuery(".update").removeClass("update");
        	e.preventDefault();
        	if(jQuery("#author").val()!="" && jQuery("#desc").val()!="" && jQuery("#title").val()!=""){
        		if(image_check(jQuery("#image_file").val())==1){
			$form_data=new FormData($('#hidden_form')[0]);
			$.ajax({
    url : "edit",
    type: "POST",
    data : $form_data,
    processData: false,
    contentType: false,
    success:function(data, textStatus, jqXHR){
            try{
              var newobj=JSON.parse(data);
             if(newobj.status){
               alert("Added Successfully!");
               window.location.href="posts.php";
                     }else{
                        alert("Some error occured");
                     }
             }catch(err){
             alert("Some internal error occured");
             }
    },
    error: function(jqXHR, textStatus, errorThrown){
        alert("Some internal error occured");
    }
});
          }
              }else{
      	alert("Please update fields");
      }
        });
         /*Delete Post*/
         $(document).on("click","#delete",function(e){
         	e.preventDefault();
            var r = confirm("Are you sure?");
            if(r){
            var id=$(this).attr("href");
            var el=$(this);
              $.post("del",{id:id},function(data){
               try{
              var newobj=JSON.parse(data);
             if(newobj.result!="Not Deleted"){
               alert(newobj.result);
            window.location.href="posts.php";
                     }else{
                        alert(newobj.result);
                     }
             }catch(err){
             $(".results_add").html("Some internal error occured");
             }
           });
          }
        });
         function image_check(data){
         	  var avatar = data;
        var extension = avatar.split('.').pop().toUpperCase();
        if(avatar.length < 1) {
            avatarok = 1;
        }
        else if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG"){
            avatarok = 0;
            alert("invalid extension "+extension);
        }
        else {
            avatarok = 1;
        }
        return avatarok;
         }
});