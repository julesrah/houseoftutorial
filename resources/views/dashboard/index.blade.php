@include('layouts.base')
@include('layouts.app')
@include('layouts.header')
<div id="chartsdiv">
    <style>
           .container-fluid1 {
               display: grid;
               grid-template-columns: 1fr 1fr 1fr;
   
               /* fraction*/
           }
           body {
                padding: 0;
                margin: 0;
                height: fit-content;
                width: 100%;
                background-image:
                    url(../css/pik.jpg);
                background-size: cover;
                background-repeat: repeat-y;
                display: grid;
                grid-template-rows: 5rem auto;
                    /* background: linear-gradient(to bottom,  white 0%, black 100%); */
            }
       </style>
   
       <div class="container-fluid1">
          
       <div class="q">
        <canvas id="conditionChart"></canvas>
        </div> 
       <div class="h">
        <canvas id="instrumentChart"></canvas>
    </div> 
    

           <div class="s">
               <canvas id="salesChart"></canvas>
           </div>

           <div class="g">
        <canvas id="serviceChart"></canvas>
    </div> 

  

    <div class="o">
        <canvas id="instructorChart"></canvas>
    </div> 

   
   
       </div>
   
       </div>
   
          </div>
   