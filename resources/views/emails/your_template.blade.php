{{-- resources/views/emails/your_template.blade.php --}}

<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <title>{{ $subject }}</title>-->
<!--</head>-->
<!--<body>-->
<!--    <h1>Forever MedSpa Campain</h1>-->

<!--    {{-- @if ($selectedTemplate)-->
<!--        <p>Using selected template with ID: {{ $selectedTemplate }}</p>-->
<!--    @endif --}}-->

<!--    {!! $htmlCode !!} {{-- Use {!! !!} to display HTML content --}}-->
<!--</body>-->
<!--</html>-->




<div id=":18p" class="a3s aiL msg-1377519352946152473">
    <u></u>           
    <div bgcolor="#f5f7fb">
      <div class="container">
       <center>
          <table cellspacing="0" cellpadding="0" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;border-collapse:collapse;" bgcolor="#f5f7fb">
             <tbody>
                <tr>
                   <table cellspacing="0" cellpadding="0" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%;max-width:640px;text-align:left">
                      <tbody>
                         <tr>
                            <td style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;padding:8px">
                               <table cellpadding="0" cellspacing="0" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%">
                                  <tbody>
                                     <tr>
                                        <td style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;padding-top:24px;padding-bottom:24px">
                                           <table cellspacing="0" cellpadding="0" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%">
                                              <tbody>
                                                 <tr>
                                                    <td style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif"><a href="https://myforevermedspa.com/" style="color:#467fcf;text-decoration:none" target="_blank" data-saferedirecturl="https://myforevermedspa.com/"><img src="https://forevermedspanj.com/wp-content/uploads/forever-color.fw_.png" width="150" height="60" alt="Forever Medspa" style="line-height:100%;outline:none;text-decoration:none;vertical-align:baseline;font-size:0;border:0 none" class="CToWUd" data-bit="iit"></a></td>
                                                    <td style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif" align="right"></td>
                                                 </tr>
                                              </tbody>
                                           </table>
                                        </td>
                                     </tr>
                                  </tbody>
                               </table>
                               <div>
                                  <table cellpadding="0" cellspacing="0" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%;border-radius:3px;border:1px solid #f0f0f0" bgcolor="#ffffff">
                                     <tbody>
                                        <tr>
                                           <td style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif">
                                              <table cellpadding="0" cellspacing="0" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%">
                                                 <tbody>
                                                    <tr>
                                                       <td class="m_-1377519352946152473content" align="center" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;padding:40px 48px 0">
                                                          <h1 style="font-weight:300;font-size:28px;line-height:130%;margin:16px 0 0" align="center">Giftcard Redeem Statement</h1>
                                                       </td>
                                                    </tr>
                                                    <tr>
                                                       <td class="m_-1377519352946152473content" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;padding:40px 48px">
                                                          {{-- <p style="margin:0 0 1em">Dear {{$statement['giftCardHolderDetails']['recipient_name']?$statement['giftCardHolderDetails']['recipient_name']:$statement['giftCardHolderDetails']['your_name']}},</p>
                                                          <p>We’ve attached your latest Giftcard Redeem Statement. You’ll be able to see the summary of transactions made for the giftcard {{$statement['result'][0]['giftnumber']}}.</p> --}}
                                                         <table border="1" cellspacing="0" cellpadding="0" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%"> 
                                                           <tr>
                                                                 <th>Sl No.</th>
                                                                 <th>Transaction Number</th>
                                                                 <th>Card Number</th>
                                                                 <th>Date</th>
                                                                 <th>Message</th>
                                                                 <th>Amount</th>
                                                             </tr>
                                                             {{-- @foreach ($statement['result'] as $key=>$item)
                                                             <tr>
                                                               <td>{{$key+1}}</td>
                                                               <td>{{$item['transaction_id']}}</td>
                                                               <td>{{$item['giftnumber']}}</td>
                                                               <td>{{date('m-d-Y',strtotime($item['updated_at']))}}</td>
                                                               <td>{{$item['comments']}}</td>
                                                               <td>{{$item['amount']}}</td>
                                                           </tr>  
                                                             @endforeach
                                                                --}}
                                                             <tr>
                                                             {{-- <td colspan="4"></td><th>Total Amount</th><td>{{$statement['TotalAmount']}}</td> --}}
                                                             </tr>
                                                             </table>
                                                          
                                                          <p>Got a question? Please email to <a href="mail:info@forevermedspanj.com"> info@forevermedspanj.com</a>or visit the nearest MedSpa Wellness Center</p>
                                                          <p></p>
                                                          <table cellspacing="0" cellpadding="0" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%">
                                                             <tbody>
                                                                <tr>
                                                                   <td style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;width:1%;padding-right:16px" valign="top"><img src="https://forevermedspanj.com/wp-content/uploads/forever-color.fw_.png" width="150" height="60" alt="" style="line-height:100%;border:0 none;outline:none;text-decoration:none;vertical-align:baseline;font-size:0;" class="CToWUd" data-bit="iit"></td>
                                                                   <td style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif" valign="middle"></td>
                                                             </tbody>
                                                          </table>
                                                          <table>
                                                             <tr cellpadding="5">
                                                                <td style="margin-top: 5px;">Team Forever Medspa</td>
                                                             </tr>
                                                          </table>
                                                       </td>
                                                    </tr>
                                                 </tbody>
                                              </table>
                                           </td>
                                        </tr>
                                     </tbody>
                                  </table>
                               </div>
                               <table cellspacing="0" cellpadding="0" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%">
                                  <tbody>
                                     <tr>
                                        <td style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;padding-top:48px;padding-bottom:48px">
                                           <table cellspacing="0" cellpadding="0" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%;color:#9eb0b7;text-align:center;font-size:13px">
                                              <tbody>
                                                 <tr>
                                                    <td align="center" style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;padding-bottom:16px">To get the latest updates click on&nbsp;<a href="https://www.facebook.com/ForeverMedSpaNJ/" style="color:#9eb0b7;text-decoration-line:none" target="_blank" data-saferedirecturl="https://www.facebook.com/ForeverMedSpaNJ/"><span style="text-decoration-line:underline">Facebook</span></a>&nbsp;</a> and <a href="https://p2h9234f.r.ap-south-1.awstrack.me/L0/https:%2F%2Fwww.instagram.com%2FForever Medspa_official%2F/1/0109018ef271a7ff-cf8fd1c8-a19f-4fe9-b381-ec1b5fb3d7b4-000000/jwEVYSgjqs8rqY_NmEARTdpTcko=151" style="color:#9eb0b7;text-decoration-line:none" target="_blank" data-saferedirecturl="https://www.instagram.com/forevermedspa/?igshid=12r8tjjaqsyy6"><span style="text-decoration-line:underline">Instagram</span></a>.</td>
                                                 </tr>
                                                 <tr>
                                                    <td style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;padding-right:24px;padding-left:24px">ⓒ {{date('Y')}} Forever MedSpa Wellness Center<br><a href="https://forevermedspanj.com/" style="color:#9eb0b7;text-decoration:none" target="_blank" data-saferedirecturl="https://forevermedspanj.com/">Home</a> | 
                                                       <a href="https://myforevermedspa.com/" style="color:#9eb0b7;text-decoration:none" target="_blank" data-saferedirecturl="https://myforevermedspa.com/">Buy Giftcard</a> <br>468 Paterson Ave East Rutherford NJ, 07073
                                                    </td>
                                                 </tr>
                                                 <tr>
                                                    <td style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;padding-top:16px">
                                                       This is an auto-generated email. Please do not reply.
                                                       <p>Need assistance? visit our <a href="https://maps.app.goo.gl/9vrG1mfqvEr1MqVY8" style="color:#9eb0b7;text-decoration:underline" target="_blank" data-saferedirecturl="https://maps.app.goo.gl/9vrG1mfqvEr1MqVY8"><span style="text-decoration:underline">Forever MedSpa Wellness Center</span></a>.</p>
                                                       <p></p>
                                                       <hr>
                                                       <p style="text-align:left"><strong></strong></p>
                                                       <p style="text-align:left"><strong>Disclaimer<br></strong>The information contained in this e-mailer has not been prepared taking into account specific </p>
                                                    </td>
                                                 </tr>
                                              </tbody>
                                           </table>
                                        </td>
                                     </tr>
                                  </tbody>
                               </table>
                            </td>
                         </tr>
                      </tbody>
                   </table>
                   </td>
                </tr>
             </tbody>
          </table>
       </center>
      </div>
       <img alt="" src="https://forevermedspanj.com/wp-content/uploads/forever-color.fw_.png" style="display:none;width:1px;height:1px" class="CToWUd" data-bit="iit">
       <div class="yj6qo"></div>
       <div class="adL"></div>
    </div>
    <div class="adL">
    </div>
 </div>
