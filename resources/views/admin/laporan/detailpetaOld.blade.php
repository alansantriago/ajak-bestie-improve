<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Peta Jabatan</title>
    <link href="{{ asset('argon') }}/img/brand/pemprovlogo.png" rel="icon" type="image/png">
</head>
<style>
    html,
    body {
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        overflow: hidden;
        font-family: Helvetica;
    }

    #tree {
        width: 100%;
        height: 100%;
    }
</style>

<body>

    <div style="" id="tree">
    </div>

    <script src="{{ asset('assets') }}/orgchart.js"></script>
    <script>
        window.onload = function () {
            OrgChart.templates.company = Object.assign({}, OrgChart.templates.ana);
  OrgChart.templates.company.size = [200, 200];
  OrgChart.templates.company.node =
      '<circle cx="100" cy="100" r="100" fill="#ffffff" stroke-width="1" stroke="#aeaeae"></circle>'
      + '<g transform="matrix(3.5,0,0,3.5,20,20)"><circle cx="12" cy="22" r="12" fill="#039BE5"></circle>'
      + '<circle cx="33" cy="14" r="10" fill="#FFCA28"></circle>'
      + '<circle cx="30" cy="32" r="8" fill="#F57C00"></circle></g>';

  OrgChart.templates.company.ripple = {
      radius: 100,
      color: "#039BE5",
      rect: null
  };

  OrgChart.templates.Struktural = Object.assign({}, OrgChart.templates.ana);
  OrgChart.templates.Struktural.size = [500, 50];
  OrgChart.templates.Struktural.node =
      '<rect x="0" y="0" width="500" height="50" fill="#016e25" stroke-width="1" stroke="#016e25"></rect>';
  OrgChart.templates.Struktural.field_0 = '<text style="font-size: 18px;" fill="#ffffff" x="250" y="30" text-anchor="middle">{val}</text>';

  OrgChart.templates.Struktural.ripple = {
      radius: 0,
      color: "#016e25",
      rect: null
  };

  OrgChart.templates.Pelaksana = Object.assign({}, OrgChart.templates.ana);
  OrgChart.templates.Pelaksana.size = [50, 300];
  OrgChart.templates.Pelaksana.node =
      '<rect x="0" y="0" width="50" height="300" fill="black" stroke-width="1" stroke="black"></rect>';
  OrgChart.templates.Pelaksana.field_0 = '<text transform="rotate(90)"  style="font-size: 14px;" fill="#ffffff" x="150" y="-20" text-anchor="middle">{val}</text>';

  OrgChart.templates.Pelaksana.ripple = {
      radius: 0,
      color: "#FFCA28",
      rect: null
  };

  OrgChart.templates.Fungsional = Object.assign({}, OrgChart.templates.ana);
  OrgChart.templates.Fungsional.size = [50, 300];
  OrgChart.templates.Fungsional.node =
      '<rect x="0" y="0" width="50" height="300" fill="orange" stroke-width="1" stroke="orange"></rect>';
  OrgChart.templates.Fungsional.field_0 = '<text transform="rotate(90)"  style="font-size: 14px;" fill="black" x="150" y="-20" text-anchor="middle">{val}</text>';

  OrgChart.templates.Fungsional.ripple = {
      radius: 0,
      color: "#FFCA28",
      rect: null
  };
  OrgChart.MIXED_LAYOUT_ALL_NODES = false;
  
  var chart = new OrgChart(document.getElementById("tree"), {
    
    // scaleInitial: OrgChart.match.boundary,
      nodeBinding: {
          field_0: "name"
      },
      tags: {
          "Company": {
              template: "company"
          },
          "Struktural": {
              template: "Struktural"
          },
          "Fungsional": {
              template: "Fungsional"
          },
          "Pelaksana": {
              template: "Pelaksana"
          }
      },
            menu: {
        pdf: { text: "Export PDF" },
        png: { text: "Export PNG" },
        svg: { text: "Export SVG" },
        },
            nodes: <?php echo $jabatan ?>
        });
        chart.load(nodes);

}
    </script>
</body>

</html>