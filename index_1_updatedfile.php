
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
?>
<?php $orderid=rand();?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Payment|Simandhar Education</title>
		<link rel="stylesheet" type="text/css" href="https://simandhareducation.com/style/style1.css">
		<link rel="stylesheet" type="text/css" href="https://simandhareducation.com/style/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="index.css">


		<link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i&amp;subset=cyrillic,hebrew,latin-ext" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

		<script src="https://simandhareducation.com/students-v6.js?v=10"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
	<link rel="shortcut icon" href="https://res.cloudinary.com/dppqknkpc/image/upload/v1635519231/Simandhar_New_Logo_3_afjpvv.png" type="image/x-icon">
		<link rel="icon" href="https://res.cloudinary.com/dppqknkpc/image/upload/v1635519231/Simandhar_New_Logo_3_afjpvv.png" type="image/x-icon">

		<script>
			var cnt=0;
			function calculate(){

				var amt =  document.getElementById("amount").value;
				var actualAmount =  localStorage.getItem("actualAmt");
				var amount ;

				var price =  $('#amount2').val();
				var tax = $('#card_type').val();
				var card_type = $('#card_type').find(':selected').data('card_val');

				if(card_type ==1 && parseInt(actualAmount)>2000){
					amount =  parseFloat(actualAmount)+parseFloat(23.60);
					amount = amount.toFixed(2);
				}
				else if(card_type ==1){
					total_int =  parseFloat(($('#card_type').val()/100)*actualAmount);
					total_amt_gst = parseFloat((18/100)*total_int)+parseFloat(total_int);
					amount = parseFloat(total_amt_gst)+ parseFloat(actualAmount);
					amount=amount.toFixed(2);

				}else{
					amount =  actualAmount*$('#card_type').val();
					amount = amount.toFixed(2);
					
				} 

				$(".sub_total_price").html("INR "+amount);
				$("#total_amt").html("INR "+amount);
				// console.log(amount);
				$('input[name=amount]').val(amount);
				// $('input[name=amount]').val(amount);   


			}
		</script>
		
		<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

	</head>
	<body>
		<!-- Modal -->  
		<div class="modal fade" id="warn_tic" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
					</div>
					<div class="modal-body">
						<div class="thank-you-pop">
							<img src="http://goactionstations.co.uk/wp-content/uploads/2017/03/Green-Round-Tick.png" alt="">
							<h1>Thank You!</h1>
							<p> Requested email is not registred with us</p>
							<button class="btn btn-primary" onclick="reload()" > Register  </button>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="modal fade" id="success_tic" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
					</div>
					<div class="modal-body">
						<div class="thank-you-pop">
							<img src="https://library.kissclipart.com/20180911/ifw/kissclipart-tick-circle-png-clipart-check-mark-clip-art-ac6119c4e046c742.jpg" alt="">
							<h1>Thank You!</h1>
							<p>Your submission is received and we will contact you soon, once the is payment done.</p>
							<a type="button" class="btn" data-dismiss="modal">Continue to Payment</a>
							<!--	<h3 class="cupon-pop"></h3> -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="success_payment" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label=""><span>×</span></button>
					</div>
					<div class="modal-body">
						<div class="thank-you-pop">
							<img src="https://library.kissclipart.com/20180911/ifw/kissclipart-tick-circle-png-clipart-check-mark-clip-art-ac6119c4e046c742.jpg" alt="">
							<h1>Thank You!</h1>
							<p>Your submission is received and we will contact you soon once the payment is verified.</p>

							<p id="payment_id"></p>
							<!--	<h3 class="cupon-pop"></h3> -->
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="pay_body">
			<i class="pay_header_bg"></i>
			<div class="pay_container">
				<div class="per_info" style="width:100%;">
					<div class="pay_header">
						<div class="pay_logo"><img src="https://simandhar-edu-assets.s3.ap-south-1.amazonaws.com/logo/New+Simandhar+Education+Logo+2022.svg" alt="payment page logo " style="margin: auto;" /></div>
						<div class="secure_tar" style="display:none;"> <span>Secure Transaction</span> <i class="secure_icon"></i></div>
					</div>
					<!--pay header-->
					<div class="clearfix"></div>
					<div class="pay_pagination">
						<span id="tab1" class="active" >Your Details</span>
						<span class="pay_nextpage "> &gt; </span>
						<span id="tab2"  >Charges Info</span>
						<span class="pay_nextpage"> &gt; </span>
						<span id="tab3">Payment</span>
					</div>
					<!--pay pagination-->
					<div class="clearfix"></div>
					<div id="block1" style="display:none !important;">
						<div class="info_dtl">
							<div class="payment_info">
								<div class="panel-group" id="accordion7401210" role="tablist" aria-multiselectable="false">
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="heading8122873">
											<h5 class="panel-title" >
												<a role="button" data-toggle="collapse" class="accordion-plus-toggle collapsed" data-parent="#accordion7401210" href="#collapse8122873" aria-expanded="false" aria-controls="collapse8122873">RazorPay(Credit/Debit Card)</a>  <span> </span>
											</h5>
										</div>
										<div id="collapse8122873" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading8122873">
											<div class="panel-body">
												<div class="payment_info">
													<select  class="cardType" name="" required="required" class="" id="card_type" onchange="calculate()">
														<option value="">Select Card Type</option>
														<option value="0.40" data-card_val='1'>Debit Cards</option>
														<!--<option value="1.0236">Domestic Credit & Debit cards on Visa, Mastercard, Maestro RuPay</option>-->
														<option value="1.0236" data-card_val='2'>Wallets: Freecharge, Mobikwik, OlaMoney, Jiomoney, Paytm, PayZapp, Jana Cash, SBI Buddy</option>
														<option value="1.0236" data-card_val='3'>Google Pay, Phone Pay, IMPS/UPI and NetBanking </option>
														<option value="1.0118" data-card_val='4'>
															Credit Cards (Visa/Master/Rupay)  </option>
														<option value="1.03245" data-card_val='5'>International Credit Cards on Visa, Mastercard, AMEX, American Express, Corporate Cards, JCB and Diners Club</option>
													</select>
													<p><input id="amount2" name="amount2" class="form-control" type="number"  maxlength="7" placeholder="Enter Amount in INR" required value="<?php if(isset($_GET['amount'])) echo $_GET["amount"];?>" disabled></p>
												</div>
												<div class="pay_course d-none" >
											<!--	<table  class="table table-bordered table-striped text-center">
														<tbody>
															
																<td  >
																	<b>Mode of Payment</b>
																</td>
																<td  >
																	<b>Razorpay Fees + 18% GST On  Razorpay Fees</b>
																</td>
															<tr>
																<td>
																 Debit cards
																</td>
																<td>
																	0.02%
																</td>
															</tr>
															<tr>
																<td>
																	Wallets: Freecharge, Mobikwik, OlaMoney, Jiomoney, Paytm, PayZapp, Jana Cash, SBI Buddy
																</td>
																<td>
																	2%
																</td>
															</tr>
															<tr>
																<td>
																	Google Pay, Phone Pay, IMPS/UPI and NetBanking 
																</td>
																<td>
																	2%
																</td>
															</tr>
															<tr>
																<td>
																	Credit Cards (Visa/Master/Rupay)
																</td>
																<td>
																	1%
																</td>
															</tr>
															<tr>
																<td>
																	International Credit Cards on Visa, Mastercard, AMEX, American Express, Corporate Cards, JCB and Diners Club
																</td>
																<td>
																	2.75%
																</td>
															</tr>
														</tbody>
													</table> -->
													<p><strong>Note: List of Debit Card payments which are not allowed</strong></p>
													<ul>
														<li>INDIAN BANK</li>
														<li>IOB DEBIT CARD</li>
														<li>IDFC FIRST DEBIT CARD</li>
														<li>ANDHRA BANK</li>
													</ul>
												</div>
											</div>
											<div class="continue_container">
												<div class="pay_continue" 
													 ><a href="javascript:void(0)" id="pay-ccavenue">Continue</a></div>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="heading411391">
											<h5 class="panel-title">
												<a role="button" data-toggle="collapse" class="accordion-plus-toggle collapsed" data-parent="#accordion7401210" href="#collapse1" aria-expanded="false" aria-controls="collapse1">Internet Banking (RTGS/NEFT )</a>  <span> </span>
											</h5>
										</div>
										<div class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading411391" id="collapse1">
											<div class="panel-body">
												<div class="clearfix"></div>
												<div>
													<div class="pay_options">
														<h3 class="bg-info">Bank Account Name</h3>
														<p>SIMANDHAR EDUCATION LLP</p>
														<hr />
														<h3>Bank Name <span class="text-primary">AXIS</span></h3>
														<hr />
														<h3>Branch Address</h3>
														<p> PLOT NO C2, GROUND FLOOR, VIKRAMPURI MAIN ROAD, NEAR SECUNDERABAD CLUB HOUSE, SECUNDERABAD 500009</p>
														<hr />
														<h3>Account Number <span>917020061587365</span></h3>
														<hr />
														<h3>RTGS/NEFT IFSC Code <span>UTIB0003281</span></h3>
														<hr />
														<h3>Account Type <span>Current</span></h3>
														<hr />
														<h3>Swift Code <span>AXISINBB068</span></h3>
														<hr />
														<hr />
														<hr>
													</div>
												</div>
												<div>
													<div class="pay_options">
														<h3 class="bg-info">Bank Account Name</h3>
														<p>SIMANDHAR EDUCATION LLP</p>
														<hr />
														<h3> Bank Name <span class="text-primary">HDFC</span></h3>
														<hr />
														<h3>Account Number <span>50200037890047</span></h3>
														<hr />
														<h3>RTGS/NEFT IFSC Code <span>HDFC0000621</span></h3>
														<hr />
														<h3>Account Type <span>Current</span></h3>
														<hr />
														<hr />
														<hr>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="panel panel-default">
										<div class="panel-heading" role="tab" id="heading2183316">
											<h5 class="panel-title">
												<a role="button" data-toggle="collapse" class="accordion-plus-toggle collapsed" data-parent="#accordion7401210" href="#collapse2183316" aria-expanded="false" aria-controls="collapse2183316">UPI Payment</a>  <span> </span>
											</h5>
										</div>
										<div id="collapse2183316" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading2183316">
											<div class="panel-body"><img src="https://simandhareducation.com/upi.png" class="img img-responsive" alt="simandhar_pay_tm"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="continue_container">
							<div class="pay_option"><img src="pay_option_icon.png" alt="pay option icon" /></div>
						</div>

						<!--course info-->
					</div>
					<div class="block2">
						<div class="info_dtl">
							<div class="payment_info">
								<div class="pay-ins-div">
								<span class="pay_instance"><input type="radio" name="pay_instance" onchange="getValue1(this)" value="new" id="pay_instance" checked=""><label for="ccavenue" style="padding-left:0.5em"><i class="ccavenue"></i> New Enrollment  </label></span>
									
								<span class="pay_instance"><input type="radio" name="pay_instance" onchange="getValue(this)" value="paid" id="pay_instance" ><label for="ccavenue" style="padding-left:0.5em"><i class="ccavenue"></i>Already Enrolled </label></span>
								</div>
								<div id="user_details2" style="display:none">
									<form class="personal_info" name="detailsForm2"   method="post">
										<p><input type="text" name="student_email" id="verify_email" placeholder="Email" class="pay_email" required="required"/></p>
										
										<p><span id="error-email" style="color:red"></span></p>
									</form>
									<p><input type="button" name="verify-enrolment" style="color:#fff" onclick="verifyEmail()" class="btn btn-primary text-white" value="Verify"/></p>
								</div>



								<div class="row m-0">

									<form class="personal_info" name="detailsForm" id="user_details"  method="post">
										<div class="col-md-12 p-top">
											<h4>Personal Information</h4>
										</div>

										<div class="col-md-12">
											<input type="text" name="billing_name" placeholder="Name" class="pay_name" required="required" id="billing_name"/>
										</div>

										<div class="col-md-8">
											<input type="email" name="billing_email" placeholder="Email" class="pay_email" required="required" id="email"/>
											
										</div>

										<div class="col-md-4">
											<input type="tel" name="billing_tel" placeholder="Phone" class="pay_phone" required maxlength="10" minlength="5" id="mobile"/>
										</div>
										<div class="col-md-12" style="
    font-weight: 600;
    padding-bottom:1em;
    
    font-size: 1.15em;
														
														
">Note: Please don't fill the Email ID already used in Becker demo. Mention accurate and complete address for timely book shipping*</div>
										<div class="col-md-12 ">
											<h4>Address </h4>
											<input type="text" name="billing_address" class="  pay_address pay_city " rows="5" cols="37"  placeholder="Address Line 1"  required="required" id="address_line1">
										</div>
										<div class="col-md-6">
											<input type="text" name="billing_address2" class="pay_city"  placeholder="Address Line 2"  required id="address_line2">
										</div>


										<div class="col-md-6">
											<input type="text" name="billing_city" class="pay_city" placeholder="Your City Name" required="required" id="city"/>
										</div>
										<div class="col-md-6">
											<select name="billing_state" required="required" id="state" class="pay_city">
												<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
												<option value="Andhra Pradesh">Andhra Pradesh</option>
												<option value="Arunachal Pradesh">Arunachal Pradesh</option>
												<option value="Assam">Assam</option>
												<option value="Bihar">Bihar</option>
												<option value="Chandigarh">Chandigarh</option>
												<option value="Chhattisgarh">Chhattisgarh</option>
												<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
												<option value="Daman and Diu">Daman and Diu</option>
												<option value="Delhi">Delhi</option>
												<option value="Goa">Goa</option>
												<option value="Gujarat">Gujarat</option>
												<option value="Haryana">Haryana</option>
												<option value="Himachal Pradesh">Himachal Pradesh</option>
												<option value="Jammu and Kashmir">Jammu and Kashmir</option>
												<option value="Jharkhand">Jharkhand</option>
												<option value="Karnataka">Karnataka</option>
												<option value="Kerala">Kerala</option>
												<option value="Lakshadweep">Lakshadweep</option>
												<option value="Madhya Pradesh">Madhya Pradesh</option>
												<option value="Maharashtra" selected>Maharashtra</option>
												<option value="Manipur">Manipur</option>
												<option value="Meghalaya">Meghalaya</option>
												<option value="Mizoram">Mizoram</option>
												<option value="Nagaland">Nagaland</option>
												<option value="Orissa">Orissa</option>
												<option value="Pondicherry">Pondicherry</option>
												<option value="Punjab">Punjab</option>
												<option value="Rajasthan">Rajasthan</option>
												<option value="Sikkim">Sikkim</option>
												<option value="Tamil Nadu">Tamil Nadu</option>
												<option value="Tripura">Tripura</option>
												<option value="Telangana">Telangana</option>
												<option value="Uttaranchal">Uttaranchal</option>
												<option value="Uttar Pradesh">Uttar Pradesh</option>
												<option value="West Bengal">West Bengal</option>
												<option value="Others">Others</option>
											</select>
										</div>
										<div class="col-md-6">
											<input type="text" name="billing_zip" class="pay_city" placeholder="Your Zip Code" required="required" id="zip"/>
										</div>
										
										<div class="col-md-12 p-top">
											<h4>Counsellor and Course Details</h4>
										</div>
										<div class="col-md-6">
											<select name="c_name" id="cname" class="pay_city" required>
												<option value="">Select Counsellor</option>
												<option value="Anuhya">Anuhya</option>
												<option value="Bharti ">Bharti  </option>
												<option value="Jayasree ">Jayasree </option>
												<option value="Kalpana">Kalpana</option>
												<option value="Radha">Radha</option>
												<option value="Rajashree">Rajashree</option>
												<option value="Shailaja ">Shailaja P </option>
												<option value="ShailajaByakodi">Shailaja Byakodi</option>
												<option value="sireesha">Sireesha</option>
												<option value="Sonam">Sonam</option>
												<option value="Sowdhamini ">Sowdhamini </option>
												<option value="Sowmya">Sowmya</option>
												<option value="Swati">Swati</option>
												<option value="Vasavi">Vasavi</option>
												<option value="Venkata ">Venkata Latesh </option>
												<option value="Others">Others</option>

												<!--<option value="Grace">Grace</option>
												<option value="sumapriya">Suma Priya</option>
												<option value="Kyvalya">Kyvalya</option>
												<option value="Akanksha">Akanksha</option>
												<option value="Abhishek">Abhishek</option>
												<option value="Sandhya">Sandhya</option>
												<option value="Annapurna">Annapurna</option>
												<option value="prabhanjan">Prabhanjan</option>
												<option value="srishti Manish">Srishti Manish</option>
												<option value="Supriya Bogi">Supriya Bogi</option>-->
												
											</select>
										</div>

										<div class="col-md-6">
											<select name="course" id="course-optd" class="pay_city"  required>
												<option value>Select Course</option> 
												<option value="CPA">CPA</option>
												<option value="CMA">CMA</option>
												<option value="CIA">CIA</option>
												<option value="IFRS">IFRS</option>
												<option value="EA">EA</option>
												<option value="Data-Analytics">Data-Analytics</option>
												<option value="Others">Other</option>
											</select>
										</div>
										
										<div class="col-md-12">
											<h4>Amount</h4>
											<input id="amount" name="amount" onchange="amountChanged()" class="pay_city" type="number" maxlength="7" placeholder="Enter Amount in INR" required >
										</div>
											<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
										<script type="text/javascript">
    $(function () {
        $("#profession").change(function () {
            if ($(this).val() == "professional") {
                $("#student-professional").show();
            } else {
                $("#student-professional").hide();
            }
        });
    });
</script>
										

										<div class="col-md-12">
											<h4>Profession </h4>
											<select name="profession_select" id="profession" class="" required>
												<option value>Select Profession</option> 
												<option  value="student"><span id="select">Student</span></option>
												<option  value="professional"><span id="select">Professional</span></option>

											</select>
										</div>

										<div class="col-md-12" id="student-professional" style="display: none">
											<h4>Company Name</h4>
											<input id="profession_company" name="profession_company" class=" " type="text" placeholder="Enter Company Name" >
										</div> 







										<div class="col-md-12">
											<div class="form-check" style="display: flex;">
												<div>
												<input class="form-check-input" type="checkbox" value="" id="terms-conditions-check" style="display:inline-block;width:50px !important;" required disabled>
												</div>
												<div>
												<label class="form-check-label" for="flexCheckChecked">
													Click below to read and accept<br>
													<button type="button" class="" data-toggle="modal" data-target="#termModal" style="border: none;background: transparent;padding: 0;margin: 0;color:#1c71b7">
														Terms and Conditions*
													</button>

												</label>	
												</div>
											</div>
										</div>
										<div class="modal fade" id="termModal" tabindex="-1" role="dialog" aria-labelledby="termModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title text-center" id="termModalLabel">Terms and Conditions</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<?php include "https://simandhareducation.com/t_and_c_table.php";?>
													</div>
													<div class="modal-footer">
														<button onClick="(function(){
																		 document.getElementById('terms-conditions-check').checked = true;
																		 $('#termModal').modal('hide')

																		 return false;
																		 })();return false;" class="btn btn-primary">I Agree</button>
													</div>
												</div>
											</div>
										</div>

										<input type="hidden" name="product_id" value="163"/>
										<input type="hidden" name="coupon" id="coupon_value" value=""/>

										<input type="hidden" name="tid" id="tid" readonly />
										<!--<input type="hidden" name="payment_capture" id="payment_capture" value="1" />-->
										<input type="hidden" name="merchant_id" value="185389"/>
										<input type="hidden" name="order_id" value="<?php echo $orderid ;?>"/>
										<input type="hidden" name="currency" value="INR"/>
										<input type="hidden"  name="redirect_url" value="http://www.simandhareducation.com/ccavResponseHandler.php"/>
										<input type="hidden" name="cancel_url" value="http://www.simandhareducation.com/ccavResponseHandler.php"/><input type="hidden" name="language" value="EN"/>


									</form>
								</div>
								<!-- Signature -->
								<!-- <section id="sign-comp" class="signature-component">
  <h2>Draw Signature with mouse or touch  </h2>
  <h2> and click on save </h2>

  <canvas id="signature-pad" width="310" height="180"></canvas>
  <div id="sign-preview"></div>

  <div>
 <button id="save">Save</button>
 <button id="clear">Clear</button>
 <button id="showPointsToggle">Show points?</button>
  </div>


</section>
-->

								<div class="continue_container">
									<div class="pay_continue" id="continue-btn"><a href="javascript:void(0)" id="next1" onclick="continueR()">Continue</a></div>
								</div>
							</div>
							<!--personal info-->
						</div>
						<div class="block3" style="display:none;">
							<div class="info_dtl_option">
								<div class="payment_info_option">
									<div class="pay_option">
										<form class="payment_option" method="post" id="myform">
											<div id="payn">
												<p>For Payment via Debit/Credit Cards or EMI</p>
												<!--<span class="pay_type"><input type="radio" name="pay_option" value="billdesk" id="billdesk" /><label for="billdesk"><i class="billdesk"></i></label></span>-->
												<span class="pay_type"><input type="radio" name="pay_option" value="ccavenue" id="ccavenue" checked/><label for="ccavenue" ><i class="ccavenue"></i></label></span>
											</div>
											<div id="payhdfc" style="display:none">
												<p>For Payment through HDFC debit/credit card</p>
												<span class="pay_type"><input type="radio" name="pay_option" value="billdesk-hdfc" id="billdesk-hdfc" /><label for="billdesk-hdfc"><i class="billdesk-hdfc"></i></label></span>
											</div>
											<div class="clearfix"></div>
											<input type="hidden" name="currency" value="INR"/>
										</form>
									</div>
								</div>
								<div class="continue_container">
									<div class="pay_option"><img src="pay_option_icon.png" alt="pay option icon" /></div>
									<div class="pay_continue"><a href="javascript:void(0)" id="makepayment">Make Payment</a></div>
								</div>
							</div>
							<!--payment option-->
						</div>
						<div class="clearfix"></div>
						<div class="pay_faqs_container desktop_pay_faqs" style="display:;">
							<h2>FAQs</h2>
							<i class="pay_faqs_border"></i>
							<div class="pay_faqs">
								<h3>When will I receive the login access to the course?</h3>
								<p>You will receive the login access within two business days after we receive the payment.</p>
							</div>
							<div class="pay_faqs">
								<h3>How can I reach the Customer Service Team for my issues?</h3>
								<p>You can contact Customer service team at our Phone number <a href="tel:+91-7780273388">+91-7780273388</a> or you can write us an email at <a href="mailto:info@simandhareducation.com">accounts@simandhareducation.com</a></p>
							</div>
							<div class="pay_faqs">
								<h3>Whom should I contact in case of any purchase related query?</h3>
								<p>Please contact the sales executive or drop a mail to <a href="mailto:accounts@simandhareducation.com">accounts@simandhareducation.com</a></p>
							</div>
							<div class="pay_faqs">
								<h3>Do I get a certificate of participation at the end of the training program?</h3>
								<p>Yes, we do provide you with a certificate of participation for all our skill based programs.</p>
							</div>
						</div>
						<!--payment faqs desktop-->
						<div class="blank_space" ></div>
					</div>
				</div>

				<div class="pay_price">
					<!-- <div class="pay_chat">
   <span>Need Help? <strong>Chat with us</strong></span>
   <i class="pay_chat_icon"></i>
   </div> -->
					<div class="clearfix"></div>
					<div class="pay_summary">
						<h5>Summary</h5>
						<div class="sub_total"style="display:none;">
							<span class="sub_total_text">Sub Total</span>
							<span class="sub_total_price"></span>
							<input type="hidden" id = "amount" value="140000"/>
							<input type="hidden" id = "currency" value="INR"/>
						</div>
						<div class="clearfix"></div>
						<div class="service_tax" style="display:none;">
							<span class="service_tax_text" id="discount_text"></span>
							<span class="service_tax_text"><span id="discount_percentage"></span></span>
							<span class="service_tax_price" id="discount_amount"></span>
						</div>
						<div class="clearfix"></div>
						<div class="promo_code" style="display:none;">
							<input type="text" name="promo_code" placeholder="Apply promo code" id="coupon" />
							<input type="button" name="promo_code" value="Apply" id="apply_coupon" style="opacity:0.4" disabled="true" />
							<div class="clearfix"></div>
							<span id="errCoupon" style="display:none;"></span>
						</div>
						<div class="clearfix"></div>
						<div class="total">
							<span class="total_text">
								Total<br>
								<p style="font-size:12px;"><em>Including Charges</em></p>
							</span>
							<span class="total_price" id="total_amt"></span>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="pay_other" style="display:none !important;">
						<div role="tabpanel" class="tab-pane" id="free_downloads">
							<div id="accordion">
								<div class="panel pay_other_option">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="pay_bank"><i class="pay_other_iocon"></i>Payment through Cheque, Demand Draft or Net Banking<i class="open_arrow"></i></a>
									<div class="clearfix"></div>
									<div id="collapse1" class="collapse">
										<div class="pay_options">
											<h3>Bank Account Name</h3>
											<p>SIMANDHAR EDUCATION LLP</p>
											<hr />
											<h3>Branch Name <span>AXIS</span></h3>
											<hr />
											<h3>Branch Address</h3>
											<p> PLOT NO C2, GROUND FLOOR, VIKRAMPURI MAIN ROAD, NEAR SECUNDERABAD CLUB HOUSE, SECUNDERABAD 500009</p>
											<hr />
											<h3>Account Number <span>917020061587365</span></h3>
											<hr />
											<h3>RTGS/NEFT IFSC Code <span>UTIB0003281</span></h3>
											<hr />
											<h3>Account Type <span>Current</span></h3>
											<hr />
											<h3>Swift Code <span>AXISINBB068</span></h3>
											<hr />
											<!--<h3>Routing Number/Sort Code <span>021000021</span></h3> -->
											<hr />
											<hr>
										</div>
									</div>
								</div>
								<!-- options for payTm -->
								<div class="panel pay_other_option" style="display:none;">
									<a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="pay_bank collapsed"><i class="pay_other_iocon"></i>Payment via UPI Wallet &nbsp;<i class="open_arrow"></i></a>
									<div id="collapse2" class="collapse in">
										<div class="pay_options text-center" style="margin:0px !important;">
											<button class="btn btn-lg btn-block btn-primary " style="margin:5px auto;"><a style="color:white;" href="http://m.p-y.tm/simandhar_web" >Click Here to Pay</a></button>
											<img src="upi.png" class="img img-responsive"  style="margin: auto" alt="simandhar_pay_tm">
											<hr/>
										</div>
									</div>
								</div>
								<!-- end of payTm Options -->
							</div>
						</div>
					</div>
					<!--pay other-->
				</div>

				<div class="clearfix"></div>
				<div class="per_info mobile_pay_faqs" style="display:;">
					<div class="pay_faqs_container">
						<h2>FAQs</h2>
						<i class="pay_faqs_border"></i>
						<div class="pay_faqs">
							<h3>When will I receive the login access to the course?</h3>
							<p>You will receive the login access within two business days after we receive the payment.</p>
						</div>
						<div class="pay_faqs">
							<h3>How can I reach the Customer Service Team for my issues?</h3>
							<p>You can contact Customer service team at our Phone number <a href="tel:+91-7780273388">+91-7780273388</a> or you can write us an email at <a href="mailto:info@simandhareducation.com">accounts@simandhareducation.com</a></p>
						</div>
						<div class="pay_faqs">
							<h3>Whom should I contact in case of any purchase related query?</h3>
							<p>Please contact the sales executive or drop a mail to <a href="mailto:accounts@simandhareducation.com">accounts@simandhareducation.com</a></p>
						</div>
						<div class="pay_faqs">
							<h3>Do I get a certificate of participation at the end of the training program?</h3>
							<p>Yes, we do provide you with a certificate of participation for all our skill based programs.</p>
						</div>
					</div>
				</div>
			</div>

			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
			<script src="http://www.simandhareducation.com/style/bootstrap.min.js"></script>
			<script type="text/javascript">

				function reload(){
					location.reload();
				}
				function getValue1(radio) {
					reload();

				}
				function getValue(radio) {

					document.getElementById('user_details').style.display = 'none';
					document.getElementById('user_details2').style.display = 'block';
					//document.getElementById('sign-comp').style.display = 'none';



				}


			</script>
			<script>
				function validateEmail(email) 
				{
					var re = /\S+@\S+\.\S+/;
					return re.test(email);
				}
				function verifyEmail(){
					var is_reg = false;
					var verify_email = document.getElementById('verify_email').value;
					var snm = document.getElementById('billing_name').value;
					if(snm){
						localStorage.setItem("sname",snm);
					}


					if(validateEmail(verify_email)){
						var obj  = new StudentRegistration();

						obj.verifyRegistration(verify_email,function(student_data){

							// console.log("student verified :",student_data);

							if(!student_data) { 
								$("#warn_tic").modal();
							}

							else {
								if(Object.keys(student_data).length > 0){



									localStorage.setItem( student_data.email, student_data.email);


									document.forms["detailsForm"]["billing_name"].value = student_data.name + " " +student_data.last_name ;
									document.forms["detailsForm"]["billing_email"].value = student_data.email ;
									document.forms["detailsForm"]["billing_tel"].value = student_data.mobile_primary ;
									document.forms["detailsForm"]["billing_address"].value = student_data.address_line1 ;
									document.forms["detailsForm"]["billing_address2"].value = student_data.address_line2 ;
									
									document.forms["detailsForm"]["billing_city"].value = student_data.city ;
									document.forms["detailsForm"]["billing_state"].value = student_data.state ;
									document.forms["detailsForm"]["billing_zip"].value = student_data.pincode ;
									document.forms["detailsForm"]["cname"].value = student_data.c_name ;				

									document.getElementById("billing_name").disabled = true;
									document.getElementById("zip").disabled = true;
									document.getElementById("zip").style.display = "none";
									document.getElementById("city").disabled = true;
									document.getElementById("city").style.display = "none";
									document.getElementById("email").disabled = true;
									document.getElementById("mobile").disabled = true;
									document.getElementById("address_line1").disabled = true;
									document.getElementById("address_line2").disabled = true;
									document.getElementById("address_line1").style.display = "none";
									document.getElementById("address_line2").style.display = "none";
									document.getElementById("state").disabled = true;
									document.getElementById("state").style.display = "none";
									document.getElementById("course-optd").disabled = false;
									//document.forms["detailsForm"]["amount"].value = 10000 ;
									//document.getElementById('sign-comp').style.display = 'none';
									document.getElementById('user_details').style.display = 'block';
									document.getElementById('user_details2').style.display = 'none';
								}
							}
							

						})
					}
					else{
						document.getElementById('error-email').innerHTML = " Please Enter Valid Email *";
					}
				}
				
				function verify(){
					var verify_email = document.getElementById('verify_email').value;

					// Call ajax for pass data to other place
					$.ajax({
						type: 'POST',
						url: 'https://simandhareducation.com/student-registration.php',
						data:"verify_email=" + verify_email 
					})
						.done(function(data){ // if getting done then call.

						// console.log("successfull",data);
						// $("#success_tic").modal('show');

						var student_data = JSON.parse(data);
						student_data = student_data[0];
						document.forms["detailsForm"]["billing_name"].value = student_data.name + " " +student_data.last_name ;

						document.forms["detailsForm"]["billing_email"].value = student_data.email ;

						document.forms["detailsForm"]["billing_tel"].value = student_data.mobile_primary ;

						document.forms["detailsForm"]["billing_address"].value = student_data.address ;

						document.forms["detailsForm"]["billing_address2"].value = student_data.address ;


						document.forms["detailsForm"]["billing_city"].value = student_data.city ;


						document.forms["detailsForm"]["billing_state"].value = student_data.state ;

						document.forms["detailsForm"]["billing_zip"].value = student_data.pincode ;

						//document.forms["detailsForm"]["amount"].value = student_data.amount ;
						//debugger;

						document.getElementById('user_details').style.display = 'block';
						document.getElementById('user_details2').style.display = 'none';


						// show the response
						$('#response').html(data);
						return true;

					})
						.fail(function(s) { // if fail then getting message
						console.log(s);
						// just in case posting your form failed

						return false;

					});

				}

				// $("#next1").click(function(){

				function continueR(){

					// disable button
					$(this).prop("disabled", true);
					// add spinner to button




					document.getElementById("amount2").value=document.getElementById("amount").value; 


					if(validateEmail(document.getElementById("email").value)){ 

						if(document.getElementById("terms-conditions-check").checked){


							var obj  = new StudentRegistration();


							obj.validate(0, function(student) {

								var x;
								if(localStorage.getItem("sign")){
									x = localStorage.getItem("sign");
									student.sign = btoa(x);
									var is_saved = false	;
								}else{
									var is_saved = true;
								}



								if(is_saved ||  localStorage.getItem(student.email)){                
									localStorage.removeItem("sign");

									if( Object.keys(student).length > 0) {
										document.getElementById("continue-btn").innerHTML = '<a href="#"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</a>';
										localStorage.setItem("actualAmt", document.getElementById("amount").value);

										obj.registerAndSendMail(student,function(status){

											console.log("registerAndSendMail",status);
											if(localStorage.hasOwnProperty(document.getElementById("email").value)){

											}
											else{
												$("#success_tic").modal();
												obj.updateLead(student);
											}
											if(document.getElementById("amount2").value>1){

												$("#tab2").addClass("active info_done");
												$(".block3").hide();
												$(".block2").hide();
												$("#block1").show();
												$("#pay-ccavenue").text("Make Payment");

											}
											else{
												alert("enter valid amount");
											}


										});
									}
								}

								//else{
								//	alert("Please Draw and Save Signature ");
								//}
							})

						}
						else{
							alert("Please accept terms and conditions");
						}
					}else{ alert("enter valid email");}



					//});
				}

				function amountChanged(){
					var amt =   document.getElementById("amount").value;
				}

				$(document).ready(function(){
					$(function () {
						$('#amount2').change(function () {      
							var price =  $('#amount2').val();
							var tax = $('#card_type').val();
							var amount =  $('input[name=amount]').val()*$('#card_type').val();
							//$("#amount").value= amount;
							$(".sub_total_price").html("INR "+amount);
							$("#total_amt").html("INR "+amount);
							console.log(amount);
							$('input[name=amount]').val(amount);
							//$('input[name=amount]').val(amount);   


						});
					});


					$(function () {
						var amt =  document.getElementById("amount").value;
						var cnt=0;


						$('#card_type1').change(function () { 
							var amount ;
							cnt = cnt+1;     

							var price =  $('#amount2').val();
							var tax = $('#card_type').val();
							if(cnt==1){
								var newAmt= document.getElementById("amount").value;
							}else{

							}
							amount =  newAmt*$('#card_type').val();
							amount = amount.toFixed(0);

							$(".sub_total_price").html("INR "+amount);
							$("#total_amt").html("INR "+amount);
							console.log(amount);
							$('input[name=amount]').val(amount);
							// $('input[name=amount]').val(amount);   

						});

					});

					$("#pay-ccavenue").click(function(){

						if(document.getElementById("card_type").value == ''){
							alert("Please select the Card type");
						}else{
							let studdent_name="";
							if(localStorage.getItem("sname")){
								studdent_name = localStorage.getItem("sname");
							}
							//$("#tab1").addClass("active info_done");
							//$("#tab2").addClass("active");
							// $("#block1").hide();
							//$(".block3").show();
							// $("#user_details").attr("action", "/payment_test/payment.php?checkout=automatic");
							// $("#user_details").submit();
							
                          // $api = new Api($key_id, $secret);

//$$api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR', 'notes'=> array('key1'=> 'value3','key2'=> 'value2')));

							var options = {
								"key": "rzp_live_reEwawElZNDzt5", // Enter the Key ID rzp_test_d6k6oj6aUcFdl4 generated from the Dashboard
								"amount":parseInt(document.getElementById("amount").value)*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
								"currency": "INR",
								"name": "Simandhar Education LLP",
								"description": document.getElementById("billing_name").value,
								"image": "http://simandhareducation.com/assets/logo-white.png",
								"handler": function (response){
									$("#success_payment").modal();
									document.getElementById("payment_id").innerHTML ="Reference ID :"+ response.razorpay_payment_id;
									localStorage.setItem("payment-details", JSON.stringify(response));
								},
								"prefill": {
									"name": document.forms["detailsForm"]["billing_name"].value,
									"email": document.forms["detailsForm"]["billing_email"].value,
									"contact": document.forms["detailsForm"]["billing_tel"].value
								},
								"notes": {
									"address": "Razorpay Corporate Office"
								},
								"theme": {
									"color": "#760b28"
								}
							};
							var rzp1 = new Razorpay(options);
							rzp1.on('payment.failed', function (response){
								alert(response.error.code);
								alert(response.error.description);
								alert(response.error.source);
								alert(response.error.step);
								alert(response.error.reason);
								alert(response.error.metadata.order_id);
								alert(response.error.metadata.payment_id);
							});

							var rzp1 = new Razorpay(options);
							rzp1.open();

						}
					}); 



					$("#makepayment").click(function(){
						var value = $('input[name=pay_option]:checked', '#myform').val() ;

						if(value=='billdesk'){
							$("#user_details").attr("action","/payments/billdesk");
							$("#user_details").submit();
						}
						else if(value=='billdesk-hdfc'){
							$("#user_details").attr("action", "/payments/billdesk-hdfc");
							$("#user_details").submit();
						}else if(value=='paypal_billdesk'){
							$("#user_details").attr("action", "/payments/paypal-billdesk-redirect");
							$("#user_details").submit();
						}
						else if(value=='ccavenue'){
							$("#user_details").attr("action", "/payment_test/payment.php?checkout=automatic");
							$("#user_details").submit();
						}
						else if(value == 'paypal'){
							$("#user_details").attr("action", "/payments/paypal");
							$("#user_details").submit();
						}
						else if(value == 'fastbanking'){ 
							$("#user_details").attr("action", "/payments/fastbanking");
							$("#user_details").submit();
						}
						else if(value=='' )
							alert("Please select a payment option");
					});


				});

				var SignaturePad = (function(document) {
					document.getElementById('sign-comp').style.display = 'block';
					var log = console.log.bind(console);

					var SignaturePad = function(canvas, options) {
						var self = this,
							opts = options || {};

						this.velocityFilterWeight = opts.velocityFilterWeight || 0.7;
						this.minWidth = opts.minWidth || 0.5;
						this.maxWidth = opts.maxWidth || 2.5;
						this.dotSize = opts.dotSize || function() {
							return (self.minWidth + self.maxWidth) / 2;
						};
						this.penColor = opts.penColor || "black";
						this.backgroundColor = opts.backgroundColor || "rgba(0,0,0,0)";
						this.throttle = opts.throttle || 0;
						this.throttleOptions = {
							leading: true,
							trailing: true
						};
						this.minPointDistance = opts.minPointDistance || 0;
						this.onEnd = opts.onEnd;
						this.onBegin = opts.onBegin;

						this._canvas = canvas;
						this._ctx = canvas.getContext("2d");
						this._ctx.lineCap = 'round';
						this.clear();

						// we need add these inline so they are available to unbind while still having
						//  access to 'self' we could use _.bind but it's not worth adding a dependency
						this._handleMouseDown = function(event) {
							if (event.which === 1) {
								self._mouseButtonDown = true;
								self._strokeBegin(event);
							}
						};

						var _handleMouseMove = function(event) {
							event.preventDefault();
							if (self._mouseButtonDown) {
								self._strokeUpdate(event);
								if (self.arePointsDisplayed) {
									var point = self._createPoint(event);
									self._drawMark(point.x, point.y, 5);
								}
							}
						};

						this._handleMouseMove = _.throttle(_handleMouseMove, self.throttle, self.throttleOptions);
						//this._handleMouseMove = _handleMouseMove;

						this._handleMouseUp = function(event) {
							if (event.which === 1 && self._mouseButtonDown) {
								self._mouseButtonDown = false;
								self._strokeEnd(event);
							}
						};

						this._handleTouchStart = function(event) {
							if (event.targetTouches.length == 1) {
								var touch = event.changedTouches[0];
								self._strokeBegin(touch);
							}
						};

						var _handleTouchMove = function(event) {
							// Prevent scrolling.
							event.preventDefault();

							var touch = event.targetTouches[0];
							self._strokeUpdate(touch);
							if (self.arePointsDisplayed) {
								var point = self._createPoint(touch);
								self._drawMark(point.x, point.y, 5);
							}
						};
						this._handleTouchMove = _.throttle(_handleTouchMove, self.throttle, self.throttleOptions);
						//this._handleTouchMove = _handleTouchMove;

						this._handleTouchEnd = function(event) {
							var wasCanvasTouched = event.target === self._canvas;
							if (wasCanvasTouched) {
								event.preventDefault();
								self._strokeEnd(event);
							}
						};

						this._handleMouseEvents();
						this._handleTouchEvents();
					};

					SignaturePad.prototype.clear = function() {
						var ctx = this._ctx,
							canvas = this._canvas;

						ctx.fillStyle = this.backgroundColor;
						ctx.clearRect(0, 0, canvas.width, canvas.height);
						ctx.fillRect(0, 0, canvas.width, canvas.height);
						this._reset();
					};

					SignaturePad.prototype.showPointsToggle = function() {
						this.arePointsDisplayed = !this.arePointsDisplayed;
					};

					SignaturePad.prototype.toDataURL = function(imageType, quality) {
						var canvas = this._canvas;
						return canvas.toDataURL.apply(canvas, arguments);
					};

					SignaturePad.prototype.fromDataURL = function(dataUrl) {
						var self = this,
							image = new Image(),
							ratio = window.devicePixelRatio || 1,
							width = this._canvas.width / ratio,
							height = this._canvas.height / ratio;

						this._reset();
						image.src = dataUrl;
						image.onload = function() {
							self._ctx.drawImage(image, 0, 0, width, height);
						};
						this._isEmpty = false;
					};

					SignaturePad.prototype._strokeUpdate = function(event) {
						var point = this._createPoint(event);
						if(this._isPointToBeUsed(point)){
							this._addPoint(point);
						}
					};

					var pointsSkippedFromBeingAdded = 0;
					SignaturePad.prototype._isPointToBeUsed = function(point) {
						// Simplifying, De-noise
						if(!this.minPointDistance)
							return true;

						var points = this.points;
						if(points && points.length){
							var lastPoint = points[points.length-1];
							if(point.distanceTo(lastPoint) < this.minPointDistance){
								// log(++pointsSkippedFromBeingAdded);
								return false;
							}
						}
						return true;
					};

					SignaturePad.prototype._strokeBegin = function(event) {
						this._reset();
						this._strokeUpdate(event);
						if (typeof this.onBegin === 'function') {
							this.onBegin(event);
						}
					};

					SignaturePad.prototype._strokeDraw = function(point) {
						var ctx = this._ctx,
							dotSize = typeof(this.dotSize) === 'function' ? this.dotSize() : this.dotSize;

						ctx.beginPath();
						this._drawPoint(point.x, point.y, dotSize);
						ctx.closePath();
						ctx.fill();
					};

					SignaturePad.prototype._strokeEnd = function(event) {
						var canDrawCurve = this.points.length > 2,
							point = this.points[0];

						if (!canDrawCurve && point) {
							this._strokeDraw(point);
						}
						if (typeof this.onEnd === 'function') {
							this.onEnd(event);
						}
					};

					SignaturePad.prototype._handleMouseEvents = function() {
						this._mouseButtonDown = false;

						this._canvas.addEventListener("mousedown", this._handleMouseDown);
						this._canvas.addEventListener("mousemove", this._handleMouseMove);
						document.addEventListener("mouseup", this._handleMouseUp);
					};

					SignaturePad.prototype._handleTouchEvents = function() {
						// Pass touch events to canvas element on mobile IE11 and Edge.
						this._canvas.style.msTouchAction = 'none';
						this._canvas.style.touchAction = 'none';

						this._canvas.addEventListener("touchstart", this._handleTouchStart);
						this._canvas.addEventListener("touchmove", this._handleTouchMove);
						this._canvas.addEventListener("touchend", this._handleTouchEnd);
					};

					SignaturePad.prototype.on = function() {
						this._handleMouseEvents();
						this._handleTouchEvents();
					};

					SignaturePad.prototype.off = function() {
						this._canvas.removeEventListener("mousedown", this._handleMouseDown);
						this._canvas.removeEventListener("mousemove", this._handleMouseMove);
						document.removeEventListener("mouseup", this._handleMouseUp);

						this._canvas.removeEventListener("touchstart", this._handleTouchStart);
						this._canvas.removeEventListener("touchmove", this._handleTouchMove);
						this._canvas.removeEventListener("touchend", this._handleTouchEnd);
					};

					SignaturePad.prototype.isEmpty = function() {
						return this._isEmpty;
					};

					SignaturePad.prototype._reset = function() {
						this.points = [];
						this._lastVelocity = 0;
						this._lastWidth = (this.minWidth + this.maxWidth) / 2;
						this._isEmpty = true;
						this._ctx.fillStyle = this.penColor;
					};

					SignaturePad.prototype._createPoint = function(event) {
						var rect = this._canvas.getBoundingClientRect();
						return new Point(
							event.clientX - rect.left,
							event.clientY - rect.top
						);
					};

					SignaturePad.prototype._addPoint = function(point) {
						var points = this.points,
							c2, c3,
							curve, tmp;

						points.push(point);

						if (points.length > 2) {
							// To reduce the initial lag make it work with 3 points
							// by copying the first point to the beginning.
							if (points.length === 3) points.unshift(points[0]);

							tmp = this._calculateCurveControlPoints(points[0], points[1], points[2]);
							c2 = tmp.c2;
							tmp = this._calculateCurveControlPoints(points[1], points[2], points[3]);
							c3 = tmp.c1;
							curve = new Bezier(points[1], c2, c3, points[2]);
							this._addCurve(curve);

							// Remove the first element from the list,
							// so that we always have no more than 4 points in points array.
							points.shift();
						}
					};

					SignaturePad.prototype._calculateCurveControlPoints = function(s1, s2, s3) {
						var dx1 = s1.x - s2.x,
							dy1 = s1.y - s2.y,
							dx2 = s2.x - s3.x,
							dy2 = s2.y - s3.y,

							m1 = {
								x: (s1.x + s2.x) / 2.0,
								y: (s1.y + s2.y) / 2.0
							},
							m2 = {
								x: (s2.x + s3.x) / 2.0,
								y: (s2.y + s3.y) / 2.0
							},

							l1 = Math.sqrt(1.0 * dx1 * dx1 + dy1 * dy1),
							l2 = Math.sqrt(1.0 * dx2 * dx2 + dy2 * dy2),

							dxm = (m1.x - m2.x),
							dym = (m1.y - m2.y),

							k = l2 / (l1 + l2),
							cm = {
								x: m2.x + dxm * k,
								y: m2.y + dym * k
							},

							tx = s2.x - cm.x,
							ty = s2.y - cm.y;

						return {
							c1: new Point(m1.x + tx, m1.y + ty),
							c2: new Point(m2.x + tx, m2.y + ty)
						};
					};

					SignaturePad.prototype._addCurve = function(curve) {
						var startPoint = curve.startPoint,
							endPoint = curve.endPoint,
							velocity, newWidth;

						velocity = endPoint.velocityFrom(startPoint);
						velocity = this.velocityFilterWeight * velocity +
							(1 - this.velocityFilterWeight) * this._lastVelocity;

						newWidth = this._strokeWidth(velocity);
						this._drawCurve(curve, this._lastWidth, newWidth);

						this._lastVelocity = velocity;
						this._lastWidth = newWidth;
					};

					SignaturePad.prototype._drawPoint = function(x, y, size) {
						var ctx = this._ctx;

						ctx.moveTo(x, y);
						ctx.arc(x, y, size, 0, 2 * Math.PI, false);
						this._isEmpty = false;
					};

					SignaturePad.prototype._drawMark = function(x, y, size) {
						var ctx = this._ctx;

						ctx.save();
						ctx.moveTo(x, y);
						ctx.arc(x, y, size, 0, 2 * Math.PI, false);
						ctx.fillStyle = 'rgba(255, 0, 0, 0.2)';
						ctx.fill();
						ctx.restore();
					};

					SignaturePad.prototype._drawCurve = function(curve, startWidth, endWidth) {
						var ctx = this._ctx,
							widthDelta = endWidth - startWidth,
							drawSteps, width, i, t, tt, ttt, u, uu, uuu, x, y;

						drawSteps = Math.floor(curve.length());
						ctx.beginPath();
						for (i = 0; i < drawSteps; i++) {
							// Calculate the Bezier (x, y) coordinate for this step.
							t = i / drawSteps;
							tt = t * t;
							ttt = tt * t;
							u = 1 - t;
							uu = u * u;
							uuu = uu * u;

							x = uuu * curve.startPoint.x;
							x += 3 * uu * t * curve.control1.x;
							x += 3 * u * tt * curve.control2.x;
							x += ttt * curve.endPoint.x;

							y = uuu * curve.startPoint.y;
							y += 3 * uu * t * curve.control1.y;
							y += 3 * u * tt * curve.control2.y;
							y += ttt * curve.endPoint.y;

							width = startWidth + ttt * widthDelta;
							this._drawPoint(x, y, width);
						}
						ctx.closePath();
						ctx.fill();
					};

					SignaturePad.prototype._strokeWidth = function(velocity) {
						return Math.max(this.maxWidth / (velocity + 1), this.minWidth);
					};

					var Point = function(x, y, time) {
						this.x = x;
						this.y = y;
						this.time = time || new Date().getTime();
					};

					Point.prototype.velocityFrom = function(start) {
						return (this.time !== start.time) ? this.distanceTo(start) / (this.time - start.time) : 1;
					};

					Point.prototype.distanceTo = function(start) {
						return Math.sqrt(Math.pow(this.x - start.x, 2) + Math.pow(this.y - start.y, 2));
					};

					var Bezier = function(startPoint, control1, control2, endPoint) {
						this.startPoint = startPoint;
						this.control1 = control1;
						this.control2 = control2;
						this.endPoint = endPoint;
					};

					// Returns approximated length.
					Bezier.prototype.length = function() {
						var steps = 10,
							length = 0,
							i, t, cx, cy, px, py, xdiff, ydiff;

						for (i = 0; i <= steps; i++) {
							t = i / steps;
							cx = this._point(t, this.startPoint.x, this.control1.x, this.control2.x, this.endPoint.x);
							cy = this._point(t, this.startPoint.y, this.control1.y, this.control2.y, this.endPoint.y);
							if (i > 0) {
								xdiff = cx - px;
								ydiff = cy - py;
								length += Math.sqrt(xdiff * xdiff + ydiff * ydiff);
							}
							px = cx;
							py = cy;
						}
						return length;
					};

					Bezier.prototype._point = function(t, start, c1, c2, end) {
						return start * (1.0 - t) * (1.0 - t) * (1.0 - t) +
							3.0 * c1 * (1.0 - t) * (1.0 - t) * t +
							3.0 * c2 * (1.0 - t) * t * t +
							end * t * t * t;
					};

					return SignaturePad;
				})(document);

				var signaturePad = new SignaturePad(document.getElementById('signature-pad'), {
					backgroundColor: 'rgba(255, 255, 255, 0)',
					penColor: 'rgb(0, 0, 0)',
					velocityFilterWeight: .7,
					minWidth: 0.5,
					maxWidth: 2.5,
					throttle: 16, // max x milli seconds on event update, OBS! this introduces lag for event update
					minPointDistance: 3,
				});
				var saveButton = document.getElementById('save'),
					clearButton = document.getElementById('clear'),
					showPointsToggle = document.getElementById('showPointsToggle');

				saveButton.addEventListener('click', function(event) {
					var data = signaturePad.toDataURL('image/png');

					var img = document.createElement('img'); 
					img.src = data; 
					document.getElementById('sign-preview').appendChild(img); 
					localStorage.setItem("sign", data); 
					// down.innerHTML = "Image Element Added.";  
					//window.open(data);
				});
				clearButton.addEventListener('click', function(event) {
					signaturePad.clear();
				});
				showPointsToggle.addEventListener('click', function(event) { 
					signaturePad.showPointsToggle();
					showPointsToggle.classList.toggle('toggle');
				});

			</script>
			<style>
				#logo{
					background: #760b28 !important;
				}
				}
			</style>
			</body>
		</html>

