<?php if(isset($templates['maps'][0]) && $maps = $templates['maps'][0]): ?> 
<section class="maps-section">
       
<script src="<?php echo e(asset('assets/global/js/maps.js')); ?>"></script>

<style>
    #map-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
    }
    #map {
        width: 100%;
        height: 100vh;
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
            height: 100vh;
        }
    }
    .tooltip {
        position: absolute;
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid #ccc;
        padding: 10px;
        font-size: 12px;
        pointer-events: none;
        opacity: 0;
        transition: opacity 0.2s;
    }
</style>

<div id="map-container">
    <div id="loading">Loading map...</div>
    <div id="map"></div>
</div>

<script>
    const indonesiaMapUrl = "<?php echo e(asset('assets/global/js/indonesia.json')); ?>";
    const baseURL = "<?php echo e($base_url); ?>";

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
        { name: "Jakarta", color: "#FA70AA" },
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
        .center([118, -2])
        .scale(1600)
        .translate([width / 2, height / 2]);

    const path = d3.geoPath().projection(projection);

    const loadingIndicator = d3.select("#loading");

    d3.json(indonesiaMapUrl).then(data => {
        displayMap(data);
    }).catch(error => {
        console.error('Error loading the map data:', error);
        loadingIndicator.style("display", "none");
    });

    const tooltip = d3.select("body")
        .append("div")
        .attr("class", "tooltip");

    const displayMap = data => {
        const features = data.features;

        svg.selectAll("path")
            .data(features)
            .enter().append("path")
            .attr("d", path)
            .attr("fill", (d, i) => stateSpecific[i] ? stateSpecific[i].color : "#ccc")
            .attr("stroke", "#fff")
            .attr("stroke-width", 1)
            .style("cursor", "pointer")
            .on("mouseover", function(event, d) {
                d3.select(this).attr("fill", "#FF5733");
                const index = features.findIndex(feature => feature === d);
                const provinceName = stateSpecific[index] ? stateSpecific[index].name : "Unknown";

               
                tooltip.transition()
                    .duration(200)
                    .style("opacity", .9);
                tooltip.html(`<strong>${provinceName}</strong><br/>Loading...`);

 
                fetchData(provinceName, tooltip);

          
                tooltip.style("left", (event.pageX + 10) + "px")
                       .style("top", (event.pageY - 28) + "px");
            })
            .on("mousemove", function(event, d) {
                
                tooltip.style("left", (event.pageX + 10) + "px")
                       .style("top", (event.pageY - 28) + "px");
            })
            .on("mouseout", function(event, d) {
                const index = features.findIndex(feature => feature === d);
                d3.select(this).attr("fill", stateSpecific[index] ? stateSpecific[index].color : "#ccc");
                tooltip.transition()
                    .duration(500)
                    .style("opacity", 0);
            })
            .on("click", function(event, d) {
                const index = features.findIndex(feature => feature === d);
                const provinceName = stateSpecific[index] ? stateSpecific[index].name : "Unknown";
                alert(`You clicked on ${provinceName}`);
                
                // Perform other actions after click if needed
                fetch(`${baseURL}/place-details/${provinceName}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            const url = `${baseURL}/category/${provinceName}`;
                            window.location.href = url;
                        } else {
                            alert(`No details found for ${provinceName}`);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching place details:', error);
                        alert('An error occurred while fetching place details.');
                    });
            })
            .append("title")
            .text((d, i) => stateSpecific[i] ? stateSpecific[i].name : "Unknown");

        svg.selectAll("foreignObject")
            .data(features)
            .enter().append("foreignObject")
            .attr("x", d => path.centroid(d)[0] - 50)
            .attr("y", d => path.centroid(d)[1] - 10)
            .attr("width", 100)
            .attr("height", 20)
            .attr("class", "province-label")
            .style("cursor", "pointer")
            .html((d, i) => `<div style="font-size:10px;">
                                <span>${stateSpecific[i].name}</span>
                            </div>`)
            .on("mouseover", function(event, d) {
                const index = features.findIndex(feature => feature === d);
                const provinceName = stateSpecific[index] ? stateSpecific[index].name : "Unknown";
            
                
                tooltip.transition()
                    .duration(200)
                    .style("opacity", .9);
                tooltip.html(`<strong>${provinceName}</strong><br/>Loading...`);

                fetchData(provinceName, tooltip);

                tooltip.style("left", (event.pageX + 10) + "px")
                       .style("top", (event.pageY - 28) + "px");
            })
            .on("mousemove", function(event, d) {
               
                tooltip.style("left", (event.pageX + 10) + "px")
                       .style("top", (event.pageY - 28) + "px");
            })
            .on("mouseout", function(event, d) {
                tooltip.transition()
                    .duration(500)
                    .style("opacity", 0);
            })
            .on("click", function(event, d) {
                const index = features.findIndex(feature => feature === d);
                const provinceName = stateSpecific[index] ? stateSpecific[index].name : "Unknown";
                
                fetch(`${baseURL}/place-details/${provinceName}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            const url = `${baseURL}/category/${provinceName}`;
                            window.location.href = url;
                        } else {
                            alert(`No details found for ${provinceName}`);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching place details:', error);
                        alert('An error occurred while fetching place details.');
                    });
            });

        loadingIndicator.style("display", "none");
    };

    const fetchData = (provinceName, tooltip) => {
        fetch(`${baseURL}/place-details/${provinceName}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    const listingsCount = data.listings_count || 0;
                    tooltip.html(`<strong>${provinceName}</strong><br/>Listings: ${listingsCount}`);
                } else {
                    tooltip.html(`<strong>${provinceName}</strong><br/>No details found`);
                }
            })
            .catch(error => {
                console.error('Error fetching place details:', error);
                tooltip.html(`<strong>${provinceName}</strong><br/>Error fetching details`);
            });
    };
</script>

</section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/sections/maps.blade.php ENDPATH**/ ?>