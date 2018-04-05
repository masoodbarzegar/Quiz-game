<?php
    $blogBaseUrl = $this->config->item('base_url');
    ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script type="text/javascript">
			$(document).ready(function() {
			    $('.refreshCaptcha').click(function(){
			        
			  		$.ajax({
						url: "<?php echo base_url('game/caprefreshajax'); ?>",
						type: 'POST',
						dataType: 'json',
						data: {
							ajax : 1
						},
						success: function(data) {
							if(data.capstate){
								$('#captImg').html(data.capdata);
							}else{
								$('#captImg').html('دوباره تلاش کنید');
							}
						}
					});
			    });
			    $('#startform #submit').click(function() {
					var player_mob   = $('#player_mob').val();
					var player_email = $('#player_email').val();
					var captch = $('#captcha').val();
					var ajax = '1';
					$('#startform #submit').prop('disabled',true);
					$('#startform #submit').attr('value' ,'');
					$('.refresh-btn').css('opacity',1);
					$('.refresh-btn').css('z-index',0);
					$.ajax({
						url: "<?php echo base_url('game/check'); ?>",
						type: 'POST',
						dataType: 'json',
						data: {
							player_mob : player_mob,
							player_email : player_email,
							captcha : captch ,
							ajax : ajax
						},
						success: function(data) {
							$('#confirmcode').modal({
							    backdrop: 'static',   // This disable for click outside event
							    keyboard: true        // This for keyboard event
							});
							$('#confirmcode').modal('show');
							if(data.ajaxState){
								$('#result').html(data.ajaxmsg);
								$('#captImg').html(data.ajaxdata);
							}else{
								$('#result').html(data.ajaxmsg);
								$('#captImg').html(data.ajaxdata);

							}
							$('#startform #submit').prop('disabled',false);
							$('.refresh-btn').css('opacity',0);
							$('.refresh-btn').css('z-index','-1');

							$('#startform #submit').show(1000);
							$('#startform #submit').attr('value' ,'Next');
						}
					});
					return false;
				});
				var yourPageWidth = window.innerWidth;
			      if (yourPageWidth < 320) {
			        alert("برای انجام این بازی عرض صفحه نمایشگر شما باید بیشتر از 320 پیکسل باشد.");
			      }
			    $("#DateCountdown").TimeCircles({
		          "animation": "smooth",
		          "bg_width": 1.2,
		          "fg_width": 0.1,
		          "circle_bg_color": "#ffffff",
		          "time": {
		            "Days": {
		              "text": "Days",
		              "color": "#FFCC66",
		              "show": false
		            },
		            "Hours": {
		              "text": "Hours",
		              "color": "#99CCFF",
		              "show": false
		            },
		            "Minutes": {
		              "text": "دقیقه",
		              "color": "#BBFFBB",
		              "show": false
		            },
		            "Seconds": {
		              "text": "",
		              "color": "#ffad00",
		              "show": true
		            }
		          }
		        });
			    //  Style the Loading direction
			    $("#DateCountdown").TimeCircles({
			        direction: "Both"
			    });
			    $("#DateCountdown").TimeCircles({
			        count_past_zero: false
			    }).addListener(countdownComplete);

			    function countdownComplete(unit, value, total) {
			        if (total <= 0) {
			          window.location = "<?php echo $blogBaseUrl;?>/game/time_finish";
			        }
			    }


			});
			function check1(){
			  document.getElementById("answers-btn1").checked = true;
			  document.getElementById("submitbtnnext").className = "btn sub0 sub2";
			}
			function check2(){
			  document.getElementById("answers-btn2").checked = true;
			  document.getElementById("submitbtnnext").className = "btn sub0 sub2";

			}
			function check3(){
			  document.getElementById("answers-btn3").checked = true;
			  document.getElementById("submitbtnnext").className = "btn sub0 sub2";
			}
			function check4(){
			  document.getElementById("answers-btn4").checked = true;
			  document.getElementById("submitbtnnext").className = "btn sub0 sub2";
			}
			function addShrinkStyle1(){
			  document.getElementById("answers-label-btn1").className = "answers-label-btn1 answers-btn hvr-shrink";
			}
			function removeShrinkStyle1(){
			  document.getElementById("answers-label-btn1").className = "answers-label-btn1 answers-btn";
			}
			function addShrinkStyle2(){
			  document.getElementById("answers-label-btn2").className = "answers-label-btn2 answers-btn hvr-shrink";
			}
			function removeShrinkStyle2(){
			  document.getElementById("answers-label-btn2").className = "answers-label-btn2 answers-btn";
			}
			function addShrinkStyle3(){
			  document.getElementById("answers-label-btn3").className = "answers-label-btn3 answers-btn hvr-shrink";
			}
			function removeShrinkStyle3(){
			  document.getElementById("answers-label-btn3").className = "answers-label-btn3 answers-btn";
			}
			function addShrinkStyle4(){
			  document.getElementById("answers-label-btn4").className = "answers-label-btn4 answers-btn hvr-shrink";
			}
			function removeShrinkStyle4(){
			  document.getElementById("answers-label-btn4").className = "answers-label-btn4 answers-btn";
			}
			function teleShare() {
				var r = confirm("Share the address of this page to Telegram?");
				if (r == true) {
				window.location.replace('https://telegram.me/share/url?text=بازی+کنید+و+سطح+زبان+خودتون+رو+بسنجید+و+سکه+طلا+ببرید+!&url='+'https://oxinchannel.com/oxinup')
				}
			}
		</script>
	</body>
</html>
