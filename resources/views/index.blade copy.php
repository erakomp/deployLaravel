

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@300;900&display=swap');

body {
  background: #f2f2f2;
}

.container  {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  height: 400px;
  width: 600px;
  background: #f2f2f2;
  overflow: hidden;
  border-radius: 20px;
  cursor: pointer;
  box-shadow: 0 0 20px 8px #d0d0d0;
}

.content {
  position: absolute;
  top: 50%;
  transform: translatey(-50%);
  text-align: justify;
  color: black;
  padding: 40px;
  font-family: 'Merriweather', serif;
}

h1 {
  font-weight: 900;
  text-align: center;
}

h3 {
  font-weight: 300;
}

.flap {
  width: 100%;
  height: 100%;
}

.flap::before {
  position: absolute;
  content: "";
  height: 100%;
  width: 50%;
  background: url("https://pbs.twimg.com/profile_images/1347260174176710658/2GfSZ1i__400x400.jpg") white;
  background-position: 100px;
  background-repeat: no-repeat;
  transition: 1s;
}

.flap::after {
  position: absolute;
  content: "";
  height: 100%;
  width: 50%;
  right: 0;
  background: url("https://pbs.twimg.com/profile_images/1347260174176710658/2GfSZ1i__400x400.jpg") white;
  background-position: -200px;
  background-repeat: no-repeat;
  transition: 1s;
}

.container:hover .flap::after {
  transform: translatex(300px);
}

.container:hover .flap::before{
  transform: translatex(-300px);
}
</style>
<body>
    <div class="container" style="display: flex; justify-content:center;">
        <div class="content">
            <h1>Test</h1>
            <form method="get" action="{{ route('exportExcel2', 'xls') }}">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group" style="margin-bottom:15px;">
                            <label for="">Start Date:</label><br>
                            <input id="startDate" type="date" name="startDate" width="500" />
    
                        </div>
                        
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group"  style="margin-bottom:15px;">
                            <label for="">End Date:</label><br>
                            <input id="endDate"  type="date" name="endDate" width="500" />
    
                        </div>
                        
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Status</label><br>
                            <select id="status" name="status">
                                <option value=" ">Select All</option>

                                <option value="1">Resources</option>
                                <option value="2">To Do List / Back Log</option>
                                <option value="3">On Hold</option>
                                <option value="4">Progressing</option>
                                <option value="5">QC</option>
                                <option value="6">Error / Must Be Fixed</option>
                                <option value="7">Done KPI</option>
                
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary" style="border-radius:50px; margin-top:10px; font-size:15px!important; display:flex; justify-content:center;">Print The report</button>

                    </div>
                </div>
            </form>
            </div>
        <div class="flap"></div>
      </div>
</body>
</html>
