        $(document).ready(function() {
			
			//Login & signup dialogues
            $("#show_login").click(function(e) {          
				$('#signup_box').hide();
				$(".message").hide();
				$("#login_box").toggle(300);
            });
            
            $("#show_signup").click(function(e) {          
				$('#login_box').hide();
				$(".message").hide();
				$("#signup_box").toggle(300);
            });
			
			$(".userbox fieldset").mouseup(function() {
				return false
			});
			$(document).mouseup(function(e) {
				if($(e.target).parents("#userbox_id").length==0) {
					$(".userbox").hide();
				}
			});	
			$("p.forgot").live("click", function(){
				$('#login_box').hide();
			});
			
			//Browse page
			//change "current" list item
			$(".to_select").live("click", function() {
				var id = $(this).parent().attr("id");
				$("#"+id+" .current").removeClass("current").addClass("to_select");
				$(this).addClass("current");
			});
			
			//Index change tab selected
			$(".tab_toselect").live("click", function() {
				$(".current").removeClass("current").addClass("tab_toselect");
				$(this).addClass("current");
			});
			
			//Show download file types
			$(".download").live("click", function(e) {
				var id= $(this).attr("rel");
				var position = $(this).position();
			
				$("#"+id).toggle().css({"top":position.top, "left":position.left + 25 });
				return true;
				});
			$(document).mouseup(function(e) {
				if($(e.target).parents(".download_types").length==0) {
					$(".download_types").hide();
				}
				});
			
        });