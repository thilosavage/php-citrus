<?php


$menucompare="";
if (isset($_POST["menucompare"]))
{

 $menucompare= $_POST['menucompare'];
 $table1 = '
                        <table id= "Table1" width="100%" border="1" cellspacing="0" cellpadding="0">
                                        <!--SW - You need a tr tag around these headers-->
                                        <th >Weeks</th>
                                        <th ><p></p></th>
                                        <th > More Details</th>


                                        <tr id="tr">

                                                <tr id= "tr " >
                                                   <td  >gggg</td>
                                                   <td >kkkkk</td>
                                                   <td >
                                                                        <form name ="dets" method="POST" action="">
                                                                                <input class = "showt" name ="wnumber" id ="wnumber" type="submit" value= "More Details" />
                                                                                <input type="hidden" name="data" value="wnumber" />
																				<input type="hidden" name="menucompare" value="'. $menucompare.'" />

                                                                                   <noscript>
                                                                                <input type="submit" value="Submit"/>
                                                                                   </noscript>
                                                                        </form>
                                                                </td>
                                                </tr>
                                        </tr>
                                </table> ';
}
if (isset($_POST["data"]))
{
        // put whatever db process you need somwhere in this if statement

         $table1 = '
                        <table id= "Table1" width="100%" border="1" cellspacing="0" cellpadding="0">
                                    <!--SW - You need a tr tag around these headers-->
                                    <th >Weeks</th>
                                    <th ><p></p></th>
                                    <th > More Details</th>


                                    <tr id="tr">

                                            <tr id= "tr " >
                                               <td  >gggg</td>
                                               <td >kkkkk</td>
                                               <td >
                                                                    <form name ="dets" method="POST" action="">
                                                                            <input class = "showt" name ="wnumber" id ="wnumber" type="submit" value= "More Details" />
                                                                            <input type="hidden" name="row_id" value="value of row id" />
                                                                            <input type="hidden" name="data" value="wnumber" />
																			<input type="hidden" name="menucompare" value="'. $menucompare.'" />
																			
																			
                                                                               <noscript>
                                                                            <input type="submit" value="Submit"/>
                                                                               </noscript>
                                                                    </form>
                                                            </td>
                                            </tr>
                                    </tr>
                            </table> ';


        $table2 = '
                          <div id="Table2">
                                  <table width="100%" border="1"  cellspacing="0" cellpadding="0">
                                          <tr>
                                                  <th id="wekkNum"> wnumber</th>
                                                  <th>Your place</th>
                                                  <th>Your arr</th>
                                          </tr>

                                          <tr >
                                                  <td>hhhh</td>
                                                  <td>kkkk</td>
                                                  <td>jjjj</td>
                                          </tr>

                                  </table>
                          </div>             
                  ';                   
}
?>

<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
        /*Start Functions*/
        function displayVals() {
                var singleValues = $("select option:selected").text();
                $("#hiddenselect").val(singleValues);
                $("p").html("Procent of : &nbsp &nbsp" + singleValues);
        }
        /*End functions*/

        /*Start Ready*/
        $(document).ready(function(){
                $("select").change(function() {
                        displayVals();
                });
        displayVals();

                $("select#menucompare").change(function() {
                        $("#aform").submit();  
                });
    });
        /*End Ready*/
</script>
<form id="aform" method="post">
        <select id="menucompare" name ="menucompare" size="1" onchange="submitaform()">
                <option selected='selected'>Select one</option>
                <option value="value1" <?php    if ($menucompare == "value1") { echo " selected='selected'"; } ?> >Text 1</option>
                <option value="value2" <?php   if ($menucompare == "value2") { echo " selected='selected'"; } ?> >Text 2</option>
                <option value="value3" <?php   if ($menucompare == "value3") { echo " selected='selected'"; } ?> >Text 3</option>
                <option value="value4" <?php    if ($menucompare == "value4") { echo " selected='selected'"; } ?> >Text 4</option>

        </select>
        <input type="hidden" name="hiddenselect" value="<?php echo $menucompare ;  ?>" />
</form>
<?php
if (isset($table1))
{
        print $table1;
}
if (isset($table2))
{
        print $table2;
}
?>