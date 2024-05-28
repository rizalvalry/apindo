@extends($theme.'layouts.app')
@section('title', trans('Map Indonesia'))

@section('banner_heading')
   @lang('Indonesian Members')
@endsection

@section('content')

<script src="{{ asset('assets/global/js/maps.js') }}"></script>

<style>
    #map-container {
        width: 100%;
        max-width: 960px;
        margin: 50px auto;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    #map {
        width: 100%;
        height: 60vh;
        position: relative;
    }
    #loading {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 1.5rem;
        color: #333;
    }
    @media (min-width: 768px) {
        #map {
            height: 70vh;
        }
    }
</style>

<div class="container">
    <div id="map-container">
        <div id="loading">Loading map...</div>
        <div id="map"></div>
    </div>
</div>

<script>
    const indonesiaMapUrl = "{{ asset('assets/global/js/indonesia.json') }}";

    const stateSpecific = [
        { name: "Papua", color: "#9D7CD6" },
        { name: "Nusa Tenggara Barat", color: "#46CFDD" },
        { name: "Gorontalo", color: "#46CFDD" },
        { name: "Sulawesi Tenggara", color: "#46CFDD" },
        { name: "Yogyakarta", color: "#FA70AA" },
        { name: "Jawa Tengah", color: "#9D7CD6" },
        { name: "Banten", color: "#997FCE" },
        { name: "Jawa Timur", color: "#FFD647" },
        { name: "Maluku Utara", color: "#997FCE" },
        { name: "Maluku", color: "#997FCE" },
        { name: "Kalimantan Selatan", color: "#FA70AA" },
        { name: "Kalimantan Barat", color: "#FA70AA" },
        { name: "Sulawesi Selatan", color: "#FFD647" },
        { name: "Jakarta Raya", color: "#FA70AA" },
        { name: "Jawa Barat", color: "#FA70AA" },
        { name: "Papua Barat", color: "#46CFDD" },
        { name: "Nusa Tenggara Timur", color: "#9D7CD6" },
        { name: "Bali", color: "#FFD647" },
        { name: "Riau", color: "#FFD647" },
        { name: "Sulawesi Tengah", color: "#9D7CD6" },
        { name: "Kalimantan Timur", color: "#FFD647" },
        { name: "Sulawesi Utara", color: "#FA70AA" },
        { name: "Papua Barat", color: "#9D7CD6" },
        { name: "Sumatera Utara", color: "#FA70AA" },
        { name: "Bangka-Belitung", color: "#46CFDD" },
        { name: "Sumatera Barat", color: "#FA70AA" },
        { name: "Kalimantan Tengah", color: "#FA70AA" },
        { name: "Sumatera Selatan", color: "#FFD647" },
        { name: "Jambi", color: "#46CFDD" },
        { name: "Lampung", color: "#997FCE" },
        { name: "Bengkulu", color: "#FA70AA" },
        { name: "Aceh", color: "#FFD647" },
        { name: "Sumatera Utara", color: "#FFD647" },
        { name: "Yogyakarta", color: "#46CFDD" }
    ];

    const width = document.getElementById("map").clientWidth;
    const height = document.getElementById("map").clientHeight;

    const svg = d3.select("#map")
        .append("svg")
        .attr("width", width)
        .attr("height", height);

    const projection = d3.geoMercator()
        .center([120, -2])
        .scale(1000)
        .translate([width / 2, height / 2]);

    const path = d3.geoPath().projection(projection);

    const loadingIndicator = d3.select("#loading");

    d3.json(indonesiaMapUrl).then(data => {
        displayMap(data);
    }).catch(error => {
        console.error('Error loading the map data:', error);
        loadingIndicator.style("display", "none");
    });

    const displayMap = data => {
        svg.selectAll("path")
            .data(data.features)
            .enter().append("path")
            .attr("d", path)
            .attr("fill", (d, i) => stateSpecific[i] ? stateSpecific[i].color : "#ccc")
            .attr("stroke", "#fff")
            .attr("stroke-width", 1)
            .on("mouseover", function(event, d) {
                d3.select(this).attr("fill", "#FF5733");
            })
            .on("mouseout", function(event, d) {
                const index = data.features.findIndex(feature => feature === d);
                d3.select(this).attr("fill", stateSpecific[index] ? stateSpecific[index].color : "#ccc");
            })
            .on("click", function(event, d) {
                const index = data.features.findIndex(feature => feature === d);
                const provinceName = stateSpecific[index] ? stateSpecific[index].name : "Unknown";
                console.log(`Clicked on: ${provinceName}`);
                alert(`You clicked on ${provinceName}`);
            })
            .append("title")
            .text((d, i) => stateSpecific[i] ? stateSpecific[i].name : "Unknown");

        loadingIndicator.style("display", "none");
    };

</script>

@endsection
