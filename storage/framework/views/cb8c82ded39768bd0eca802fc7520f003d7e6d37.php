<?php if(isset($templates['maps'][0]) && $maps = $templates['maps'][0]): ?> 
<section class="maps-section">
       
<script src="<?php echo e(asset('assets/global/js/maps.js')); ?>"></script>

<style>
    #map-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
        position: relative;
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
            height: 70vh;
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
    .zoom-controls {
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        flex-direction: column;
    }
    .zoom-controls button {
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 5px;
        cursor: pointer;
        margin-bottom: 5px;
        font-size: 16px;
    }
</style>

<div id="map-container">
    <div id="loading">Loading map...</div>
    <div id="map"></div>
    <div class="zoom-controls">
        <button id="zoom-in">+</button>
        <button id="zoom-out">-</button>
    </div>
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
        .attr("width", "100%")
        .attr("height", "100%")
        .attr("viewBox", `0 0 ${width} ${height}`)
        .attr("preserveAspectRatio", "xMidYMid meet");

    const projection = d3.geoMercator()
        .center([118, -2])
        .scale(width < 720 ? width / 1.6 : width / 1.2)
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

    const zoom = d3.zoom()
        .scaleExtent([1, 8])
        .on('zoom', (event) => {
            svg.selectAll('path')
                .attr('transform', event.transform);
            svg.selectAll('.province-label')
                .style("display", "none"); // Menyembunyikan teks provinsi saat zoom
        });

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

        svg.selectAll(".province-label")
            .data(features)
            .enter().append("text")
            .attr("class", "province-label")
            .attr("x", d => path.centroid(d)[0])
            .attr("y", d => path.centroid(d)[1])
            .attr("text-anchor", "middle")
            .attr("dy", ".35em")
            .attr("font-size", "10px")
            .attr("fill", "#000")
            .style("pointer-events", "none")
            .style("display", "block") // Menampilkan teks provinsi secara default
            .text((d, i) => stateSpecific[i] ? stateSpecific[i].name : "Unknown");

        loadingIndicator.style("display", "none");

        // Conditionally enable zoom based on window width
        if (window.innerWidth >= 280 && window.innerWidth <= 780) {
            svg.call(zoom);
        } else {
            svg.on('.zoom', null); // Disable zoom if outside the specified range
        }
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

    document.getElementById('zoom-in').addEventListener('click', () => {
        svg.transition().call(zoom.scaleBy, 1.3);
    });

    document.getElementById('zoom-out').addEventListener('click', () => {
        svg.transition().call(zoom.scaleBy, 1 / 1.3);
    });

    window.addEventListener('resize', () => {
        // Recalculate zoom settings on window resize
        const newWidth = document.getElementById("map").clientWidth;
        const newHeight = document.getElementById("map").clientHeight;

        projection.scale(newWidth < 780 ? newWidth / 1.8 : newWidth / 1.5)
                  .translate([newWidth / 2, newHeight / 2]);

        svg.selectAll('path').attr('d', path);
        svg.selectAll('.province-label')
            .attr("x", d => path.centroid(d)[0])
            .attr("y", d => path.centroid(d)[1]);

        if (window.innerWidth >= 280 && window.innerWidth <= 780) {
            svg.call(zoom);
        } else {
            svg.on('.zoom', null); // Disable zoom if outside the specified range
        }
    });
</script>

</section>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/sections/maps.blade.php ENDPATH**/ ?>