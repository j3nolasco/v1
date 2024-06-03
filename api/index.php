<?php

$jsonString = file_get_contents('Data.json', FILE_USE_INCLUDE_PATH);
$data = json_decode($jsonString, true);
$reportEntries = $data['Report_Entry']; 
foreach($data as $key => $value){
          $arrayCount = count($value);
        } 
        $Rentry = $data['Report_Entry'];
        $AcademicPeriod = "";
        for ( $i = 0; $i < $arrayCount; $i++ ){
            $firstReport = $Rentry[$i];
            $AcademicPeriod = $firstReport['Academic_Period'];
        }
           

    
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>v1</title>
</head>
<body>

  <div class = "course-catalog"> 
  <div class = "print-screen">
    </div>
    <section class = "left">
        <div class = "filter-container">
            <div class = "filter-content">
                <h1 class = "filter">Filter</h1>
                <input class = "text" type="text" id="myInput" onkeyup="filterByName(this)" placeholder="Search for courses...">
                <h1>academic-period</h1>
                <select class = "academic-periods" name="academic-periods" id="inputPeriod" >
                    <option value="<?=$AcademicPeriod ?>" disabled selected> Select Academic Period </option>
                <?php
                         $new_array = array();
                         for ( $i = 0; $i < $arrayCount; $i++ ){
                             $firstReport = $Rentry[$i];
                             $AcademicPeriod = $firstReport['Academic_Period'];
                             if(!in_array($AcademicPeriod, $new_array)){ 
                                  $new_array[$i] = $AcademicPeriod;
                                  $NewAcademicPeriod = $new_array[$i];
                                  ?>
                                  <option value="<?=$NewAcademicPeriod ?>"><?=$NewAcademicPeriod ?></option>"
                                  <?php
                                }
                             ?>                           
                         <?php
                         }?>
                </select>
                <h1>Delivery Mode</h1>
                <select class="delivery-mode" name="delivery-mode" id="inputMode"  >
                    <option value="In-Person" disabled selected> Select Delivery Mode </option>
                <?php
                         $new_array = array();
                         for ( $i = 0; $i < $arrayCount; $i++ ){
                             $firstReport = $Rentry[$i];
                             $DeliveryMode = $firstReport['Delivery_Mode'];
                             if(!in_array($DeliveryMode, $new_array)){ 
                                  $new_array[$i] = $DeliveryMode;
                                  $DeliveryMode = $new_array[$i];
                                  ?>
                                  <option value="<?=$DeliveryMode ?>"><?=$DeliveryMode ?></option>"
                                  <?php
                                }
                             ?>                           
                         <?php
                         }?>
                </select>

                <br></br>
                <button onclick="resetValues()">reset</button>
                <button onclick="print()">Print</button>
            </div>
        </div>
    </section>
    <section class ="right">
        <div class = "courses-container">
                <div class = "course-content">
                    <h1 class = "title">Courses</h1>
                    <div class = "courses-grid" id = "list">
                        <?php
                         
                            for ( $i = 0; $i < $arrayCount; $i++ ){
                                $firstReport = $Rentry[$i];
                                $CourseListing = $firstReport['Course_Listing'] ;
                                $CourseSubjects = $firstReport['Course_Subjects'];
                                $SectionCapacity = $firstReport['Section_Capacity'];
                                $AcademicLevel = $firstReport['Academic_Level'];
                                $DeliveryMode = $firstReport['Delivery_Mode'];
                                $StartDate = $firstReport['Start_Date'];
                                $EndDate = $firstReport['End_Date'];
                                $AcademicPeriod = $firstReport['Academic_Period'];
                                $count = $i;
                                if(array_key_exists('Meeting_Pattern', $firstReport))
                                        {
                                            $MeetingPattern = $firstReport['Meeting_Pattern'];
                                          
                                        }else{
                                            $MeetingPattern = 'NA';
                                        }
                                if(array_key_exists('Instructors', $firstReport))
                                        {
                                            $Instructor = $firstReport['Instructors'];
                                        
                                        }else{
                                            $Instructor = 'NA';
                                        }
                            
                                ?>
                                
                                <div class = "course-card" id="<?=$i ?>" onclick ="drillBox(this)" >
                                    <div class = "course-card_L">
                                        <h3 class = "course-listing"><?=$CourseListing ?></h3>
                                        <!-- <p class = "course-subjects"><?=$CourseSubjects ?></p> -->
                                        <p style = "display: inline;" class = "Academic-Period"><?=$AcademicPeriod ?></p> <p style = "display: inline;"> | </p>
                                        <p style = "display: inline;" class = "delivery-mode"><?=$DeliveryMode ?></p>
                                        
                                        
                                       
                                        <h3>Instructor</h3>
                                        <p class = "instructor"><?=$Instructor ?></p>
                                    </div>
                                    <div class = "course-card_R">
                                        <h3 class = "meeting-header">Metting Pattern</h3>
                                        <p class = "meeting-pattern"><?=$MeetingPattern ?></p> 
                                       
                                        
                                        <p class = "academic_level"><?=$AcademicLevel ?></p>   
                                    </div>
                                </div>
                               
                            <?php
                            }?>

                                <button type = "button" class="leave" id="leave" style="display:none" onclick="closeDrill()">X</button>
                                <div class = "drill-down" id = "drill" style="display:none">    
                                    <?php
                                    for ( $j = 0; $j < $arrayCount; $j++ ){
                                        $firstReport = $Rentry[$j];
                                        $CourseListing = $firstReport['Course_Listing'] ;
                                        $CourseSubjects = $firstReport['Course_Subjects'];
                                        $SectionCapacity = $firstReport['Section_Capacity'];
                                        $AcademicLevel = $firstReport['Academic_Level'];
                                        $DeliveryMode = $firstReport['Delivery_Mode'];
                                        $AcademicPeriod = $firstReport['Academic_Period'];
                                        $StartDate = $firstReport['Start_Date'];
                                        $EndDate = $firstReport['End_Date'];
                                        
                                        $Units = $firstReport['Units_and_Unit_Type'];
                                        $count = $j;
                                        if(array_key_exists('Requirements', $firstReport))
                                        {
                                            $Requirements = $firstReport['Requirements'];
                                          
                                        }else{
                                            $Requirements = 'No Requirements';
                                        }
                                        if(array_key_exists('Course_Description', $firstReport))
                                        {
                                            $CourseDescription = $firstReport['Course_Description'];
                                          
                                        }else{
                                            $CourseDescription = 'No Description Provided';
                                        }
                                        
                                       
                                ?>
                                    <div class ="drill-info" id = "drill-info" style="display:none">
                                        <a style = "display:none"><?=$j ?></a>
                                        <h3 class = "course-listing"><?=$CourseListing ?></h3>
                                        <!-- <p class = "course-subjects"><?=$CourseSubjects ?></p>   -->
                                        <p style = "display: inline;" class = "academic-period"> <?=$AcademicPeriod ?> | </p> 
                                        <p style = "display: inline;" class = "delivery-mode"><?=$DeliveryMode ?><p>
                                        <h4 style = "display: inline">Start Date: </h4> <p style = "display: inline"class = "start-date"><?=$StartDate ?></p>
                                        <h4 style = "display: inline">End Date: </h4><p style = "display: inline" class = "end-date"><?=$EndDate ?></p>
                                        <h4>Course Summary</h4>
                                        <p class = "course-description"><?=$CourseDescription ?></p>
                                        <h4>Course Requirements</h4>
                                        <p class = "requirements"><?=$Requirements ?></p>     
                                        
                                    </div>  
                                    <?php
                                }?> 
                                </div>
                                <div class = "shadow" id = "shadow" style="display:none"></div>
                    </div>
                </div>
            </div>
            
        </section>
    </div>

<script>
    const Textinput =document.getElementById("myInput");
    Textinput.addEventListener("input",filterByName());

    const input = document.getElementById("inputPeriod");
    var filter = input.value.toUpperCase();
    const list =document.getElementById("list");
    var div = list.getElementsByClassName("course-card");
    var sels =document.getElementsByTagName('select');

    var filterArray = [];
    var serachValue = "";

    var courseSerach= false;
    var ap = false;
    var dm = false;
    var mp = false;
    var selected_Period = document.getElementById("inputPeriod").value.toUpperCase();
    var selected_Mode = document.getElementById("inputMode").value.toUpperCase();

    var apSelection = "";
    var dmSelection = "";
    var alSelection = "";

    function resetValues(){

        Textinput.value = "";

      for(i=0; i<sels.length; i++){
        sels[i].selectedIndex=0;
      }
      
      
        for(i=0; i < div.length; i++){
                
                    div[i].style.display = "";
                   
                
            }
        }
    
        
        //filter dropdowns -----------------------------------------------------------------------------------------------------------------

        for(j=0; j<sels.length; j++){
          sels[j].addEventListener('change', function(){
            selectionId = this.id;

            var selectedPeriod =document.getElementById("inputPeriod").value.toUpperCase();
            var selectedMode = document.getElementById("inputMode").value.toUpperCase();
         
            if(selectionId === "inputPeriod")
            {
                ap = true;
                if (dm){
                    
                    for(i = 0; i<div.length; i++)
                  {
                      const h3 = div[i].getElementsByTagName("h3")[0];
                      const p = div[i].getElementsByTagName("p")[0];
                      const dms = div[i].getElementsByTagName("p")[2];
                   
                      if((p.innerHTML.toUpperCase() == selectedPeriod) && (dms.innerHTML.toUpperCase() == selectedMode))
                      {
                        div[i].style.display = "";
                        apSelection = p.innerHTML;
                        selected_Period =selectedPeriod;

                      }else{
                        div[i].style.display = "none";
                      }
                  } 
                }else{
                
                  for(i = 0; i<div.length; i++)
                  {
                      const p = div[i].getElementsByTagName("p")[0];
                      console.log(p.innerHTML);
                      if(p.innerHTML.toUpperCase() == selectedPeriod)
                      {
                        
                        div[i].style.display = "";
                        apSelection = p.innerHTML;
                        selected_Period =selectedPeriod;
                       

                      }else{
                        div[i].style.display = "none";
                      }
                  }    
                }   
            }
            if(selectionId === "inputMode")
            {
              dm = true;
              if(ap)
              {
                for(var i =0; i<div.length; i++)
                {
                    const h3 = div[i].getElementsByTagName("h3")[0];
                    const ap = div[i].getElementsByTagName("p")[0];
                    const p = div[i].getElementsByTagName("p")[2];

                        
                      if((p.innerHTML.toUpperCase() == selectedMode) && (ap.innerHTML.toUpperCase() == selectedPeriod))
                      {
                       div[i].style.display = "";
                       dmSelection = p.innerHTML;
                       selected_Mode =selectedMode;

                      }else{
                        div[i].style.display = "none";
                      }
                }
              }else{ 
                for(var i =0; i<div.length; i++)
                {
                        const p = div[i].getElementsByTagName("p")[2];
                        if(p.innerHTML.toUpperCase() == selectedMode)
                        {
                        div[i].style.display = "";
                        dmSelection = p.innerHTML;
                        selected_Mode =selectedMode;

                        }else{
                            div[i].style.display = "none";
                        }
                }
             }
            }     
          }, false);}

          // end of drop downs----------------------------------------------------------------------------------------------------------
   
function filterByName(){
    
    const filter = Textinput.value.toUpperCase();
    const list =document.getElementById("list");
    div = list.getElementsByClassName("course-card");
    filterArray = [];

    serachValue =filter;

      if(dm || ap)
      {
        for(i=0; i < div.length; i++){
            const h3 = div[i].getElementsByTagName("h3")[0];
            const ins = div[i].getElementsByTagName("p")[4];
            const ap = div[i].getElementsByTagName("p")[0];
            const dms = div[i].getElementsByTagName("p")[2];

            if((h3)){
                if(((h3.innerHTML.toUpperCase().indexOf(filter) > -1) ||  (ins.innerHTML.toUpperCase().indexOf(filter) > -1)) && (ap.innerHTML.toUpperCase() == selected_Period) && (dms.innerHTML.toUpperCase() == selected_Mode)){
                    div[i].style.display = "";
                   
                } else {
                    div[i].style.display = "none";
                    
                }
            }
        }
    } else{
        
        for(i=0; i < div.length; i++){
            const h3 = div[i].getElementsByTagName("h3")[0];
            const ins = div[i].getElementsByTagName("p")[4];
            
            if(h3 || ins){
                if(h3.innerHTML.toUpperCase().indexOf(filter) > -1 || ins.innerHTML.toUpperCase().indexOf(filter) > -1){
                    div[i].style.display = "";
                    filterArray.push(div[i]);
                    //console.log("p: "+ ins.innerHTML);
                 
                } else {
                    div[i].style.display = "none";
                    courseSerach = true;
                }
            }
        }
    } 
        
}

    function drillBox(element){
        const shadow =document.getElementById("shadow");
        const exit =document.getElementById("leave");
        const drillDown =document.getElementById("drill");
        const drillInfo =drillDown.getElementsByClassName("drill-info");
        const list =document.getElementById("list");
        const div = list.getElementsByClassName("course-card");
        drillDown.style.display = "block";
        shadow.style.display="block";
        exit.style.display="block";   

        const parent  = element.id;
      

        for(i=0; i < drillInfo.length; i++){
          const h3c = div[i].getElementsByTagName("h3")[0];
          const h3d = drillInfo[i].getElementsByTagName("h3")[0]; 
       
            if(i == parent)
            {
                drillInfo[i].style.display = "block";             
            }else {
                drillInfo[i].style.display = "none";
            }
        }
    }
   
    function closeDrill(){
        const box =document.getElementById("drill");
        const shadow =document.getElementById("shadow");
        const exit =document.getElementById("leave");
        box.style.display = "none";
        shadow.style.display="none";
        exit.style.display="none";
    }
    function printPage(){
    window.print();
}

    function openPrint(){
        window.print("iframe.html","Print","rel=noopener");
    }

  </script>
<style>

.print-screen{
    position: fixed;
    left: 20;
    top: 20;
    z-index: 5;

    
    background-color: lightgray;
    border-radius: 50%;
}
body{
    margin: 0;
    padding: 0;
}
.course-catalog{
    display: flex;
   height: 100%;
   width: 100%;
}

.left{
    width: 25%;
    float: left;
}
.right{
    float: left;
    width: 90%;
}

.filter-container{
   
    position: fixed !important;
    display: flex;
    background-color: darkolivegreen;
    color: white;
    box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
    height: 100%;
    width: auto;
    flex-direction: row;
    padding: 2rem;
    gap: 2rem;
    overflow-y: hidden !important;

}

.courses-grid{
    display: grid;
    grid-template-columns: 1fr ;
    grid-template-rows: auto auto;
    gap: 1rem;
   
}
.course-card{
    
    display: grid;
    grid-template-columns: (2 ,1fr);
    background-color: lightgray;
    box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
    border-radius: 1.7rem;
    height: auto;
    width: 95%;
    padding: 1rem; 
    padding-top: .2rem !important;
   
    float: left;
    &:hover{
        transform: scale(1.01);
    transition: all .4s ease-in-out;
  
   
  }  
}
.course-card_L{
    grid-column: 1;
}
.course-card_R{
    grid-column: 2;
}

.drill-down{
    position: fixed;
    z-index: 2;
    background-color: lightgray;
    box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
    border-radius: 1.7rem;
    inset: 0px;
    width: 80%;
    height: 80%;
    margin: auto;
    pointer-events: none;
    
}
.drill-info{
    padding: 1rem;
}
.leave{
    position: fixed;
    z-index: 5;
    background-color: lightgray;
    border-radius: 1.7rem;
    height: 50px;
    width: 50px;
    left: 80%
  
}
.shadow{
    position: absolute;
    z-index: 1;
    box-shadow: 0 0 0 99999px rgba(0, 0, 0, .5);
}
@media print{
    .course-catalog{
        display: block;
}
.title{
    display: none;
}
    .left{
        display: none !important;
    }
    .filter-container{
        display: none !important;
    }
    .course-card{
    display: block;
    height: auto;
    width: 100%;
    }  
    .course-card_R{

    grid-column: 2;
    float: left;    
    }
}


@media screen and (max-width: 430px){
    .filter{
    display: none;
}
    .print{
        display: none;
    }
    .course-catalog{
        display: inline-block;
        
    }
   .left{ 
        width: 100%;
   }

    .right{
  
      width: 92%;
  
    }
   .filter-container{
    display: flex;
    flex-direction: row;
    height: 4%;
    width: 100%;
    padding: 1rem;
   }

   .filter-content h1{
    display: none;
   }
   .text{
    font-size: 16px;
   }
   
   .academic-periods{
    width: 80px;
    height: 40px;
 
   }
   .delivery-mode{
    width: 80px;
    height: 40px;
   
   }
   .courses-grid{
    padding: .5rem;
    gap: 1rem;
}
   .course-card{
    display: block;
    vertical-align: middle;
    background-color: lightgray;
    box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
    border-radius: .2rem;
    height: auto;
    width: 100%;
   

}  
    .course-card_L{

    margin-bottom: 0rem;
    margin-right: 5rem;

    
}
    .indicator{
    display:none !important;
}
    .course-card_R{
    margin-left:0rem;
    margin-bottom: 0rem;
   
  
    
}
.drill-down{
    position: fixed;
    z-index: 2;
    background-color: lightgray;
    box-shadow: 0px 0px 10px rgb(0 0 0 / 10%);
    border-radius: 1.7rem;
    inset: 0px;
    width: 90%;
    height: 95%;
    margin: auto;
    pointer-events: none;
    
}
.drill-info{
    padding: 1rem;
}
.leave{
    position: fixed;
    z-index: 5;
    background-color: lightgray;
    border-radius: 1.7rem;
    height: 50px;
    width: 50px;
    left: 80%;
    top: 1%;
  
}

}
</style>
    
</body>
</html>