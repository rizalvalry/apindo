<?php if(isset($templates['maps'][0]) && $maps = $templates['maps'][0]): ?>

<section class="maps-section">

<script src="<?php echo e(asset('assets/global/js/maps.js')); ?>"></script>

<style>
    #map-container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
        overflow-x: auto;
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
    @media (max-width: 520px) {
        #map-container {
            overflow-x: auto;
        }
        #map {
            width: 150%;
        }
    }
    #legend-container {
        width: 100%;
        max-width: 100%;
        margin-top: 20px;
    }
    #legend-table {
        width: 100%;
        border-collapse: collapse;
    }
    #legend-table th, #legend-table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: center;
        cursor: pointer;
    }
    #legend-table th {
        background-color: #f4f4f4;
    }
    tr {font-size:12px; color: blue;}
    .province-label {
        font-size: 10px;
        fill: #000;
        pointer-events: none;
    }
</style>

<div id="map-container">
    <div id="loading">Loading map...</div>
    <div id="map"></div>
</div>

<div class="container mb-4">
    <div id="legend-container">
        <table id="legend-table">
            <thead>
                <tr>
                    <th colspan="3">Legends Maps</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
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
        { name: "Papua Tengah", color: "#46CFDD" },
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
        .scale(width > 720 ? 1600 : 800)
        .translate([width / 2, height / 2]);

    const path = d3.geoPath().projection(projection);

    const loadingIndicator = d3.select("#loading");

    // Fetch all province data on page load
    let provinceData = {};
    const fetchAllData = async () => {
        for (const state of stateSpecific) {
            try {
                const response = await fetch(`${baseURL}/place-details/${state.name}`);
                
                if (!response.ok) {
                    if (response.status === 500) {
                        console.clear();
                        // Handle 404 Not Found
                    } else {
                        // Handle other errors
                        console.error(`Error fetching place details (${response.status}): ${response.statusText}`);
                        provinceData[state.name] = null;
                    }
                } else {
                    const data = await response.json();
                    provinceData[state.name] = data;
                }
            } catch (error) {
                console.error('Error fetching place details:', error);
                provinceData[state.name] = null;
            }
        }
    };

    const initializeMap = async () => {
        await fetchAllData();

        d3.json(indonesiaMapUrl).then(data => {
            displayMap(data);
        }).catch(error => {
            // console.error('Error loading the map data:', error);
            loadingIndicator.style("display", "none");
        });
    };

    const tooltip = d3.select("body")
        .append("div")
        .attr("class", "tooltip");

    const displayMap = data => {
        const features = data.features;

        const group = svg.selectAll("g")
            .data(features)
            .enter().append("g")
            .attr("class", "province-group")
            .on("mouseover", function(event, d) {
                d3.select(this).select("path").attr("fill", "#FF5733");
                const index = features.findIndex(feature => feature === d);
                const provinceName = stateSpecific[index] ? stateSpecific[index].name : "Unknown";

                tooltip.transition()
                    .duration(200)
                    .style("opacity", .9);
                tooltip.html(`<strong>${provinceName}</strong><br/>Loading...`);

                if (provinceData[provinceName]) {
                    const listingsCount = provinceData[provinceName].listings_count || 0;
                    tooltip.html(`<strong>${provinceName}</strong><br/>Listings: ${listingsCount}`);
                } else {
                    tooltip.html(`<strong>${provinceName}</strong><br/>No details found`);
                }

                tooltip.style("left", (event.pageX + 10) + "px")
                       .style("top", (event.pageY - 28) + "px");
            })
            .on("mousemove", function(event, d) {
                tooltip.style("left", (event.pageX + 10) + "px")
                       .style("top", (event.pageY - 28) + "px");
            })
            .on("mouseout", function(event, d) {
                const index = features.findIndex(feature => feature === d);
                d3.select(this).select("path").attr("fill", stateSpecific[index] ? stateSpecific[index].color : "#ccc");
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

        group.append("path")
            .attr("d", path)
            .attr("fill", (d, i) => stateSpecific[i] ? stateSpecific[i].color : "#ccc")
            .attr("stroke", "#fff")
            .attr("stroke-width", 1)
            .style("cursor", "pointer");

        // Append text labels to a separate layer to ensure they are on top
        const labelGroup = svg.append("g").attr("class", "label-group");
        labelGroup.selectAll("text")
            .data(features)
            .enter().append("text")
            .attr("x", d => path.centroid(d)[0])
            .attr("y", d => path.centroid(d)[1])
            .attr("text-anchor", "middle")
            .attr("dominant-baseline", "central")
            .attr("class", "province-label")
            .style("pointer-events", "none")
            .style("fill", "#000")
            .style("font-size", "10px")
            .text((d, i) => stateSpecific[i] ? stateSpecific[i].name : "");

        loadingIndicator.style("display", "none");

        createLegendTable();
    };

    const customOrder = [
    { name: "Aceh", color: "#FF5733" },
    { name: "Sumatra Utara", color: "#FA70AA" },
    { name: "Sumatra Selatan", color: "#FFD647" },
    { name: "Sumatra Barat", color: "#FA70AA" },
    { name: "Bengkulu", color: "#FA70AA" },
    { name: "Riau", color: "#FFD647" },
    { name: "Kepulauan Riau", color: "#46CFDD" },
    { name: "Jambi", color: "#FFD647" },
    { name: "Lampung", color: "#997FCE" },
    { name: "Bangka Belitung", color: "#46CFDD" },
    { name: "Kalimantan Barat", color: "#FA70AA" },
    { name: "Kalimantan Timur", color: "#FFD647" },
    { name: "Kalimantan Selatan", color: "#FA70AA" },
    { name: "Kalimantan Tengah", color: "#46CFDD" },
    { name: "Kalimantan Utara", color: "#46CFDD" },
    { name: "Banten", color: "#997FCE" },
    { name: "Jakarta", color: "#FA70AA" },
    { name: "Jawa Barat", color: "#FA70AA" },
    { name: "Jawa Tengah", color: "#9D7CD6" },
    { name: "DIY Yogyakarta", color: "#46CFDD" },
    { name: "Jawa Timur", color: "#FFD647" },
    { name: "Bali", color: "#FFD647" },
    { name: "Nusa Tenggara Timur", color: "#9D7CD6" },
    { name: "Nusa Tenggara Barat", color: "#46CFDD" },
    { name: "Gorontalo", color: "#46CFDD" },
    { name: "Sulawesi Barat", color: "#9D7CD6" },
    { name: "Sulawesi Tengah", color: "#46CFDD" },
    { name: "Sulawesi Utara", color: "#FA70AA" },
    { name: "Sulawesi Tenggara", color: "#46CFDD" },
    { name: "Sulawesi Selatan", color: "#FFD647" },
    { name: "Maluku Utara", color: "#997FCE" },
    { name: "Maluku", color: "#997FCE" },
    { name: "Papua Barat", color: "#46CFDD" },
    { name: "Papua", color: "#FFD647" },
    { name: "Papua Tengah", color: "#9D7CD6" },
    { name: "Papua Pegunungan", color: "#46CFDD" },
    { name: "Papua Selatan", color: "#FFD647" },
    { name: "Papua Barat Daya", color: "#46CFDD" }
];

const createLegendTable = () => {
    const tbody = document.querySelector("#legend-table tbody");
        tbody.innerHTML = ""; // Clear existing table content
        let row;
        customOrder.forEach((state, index) => {
            if (index % 3 === 0) {
                row = document.createElement("tr");
                tbody.appendChild(row);
            }
            const cell = document.createElement("td");
            const link = document.createElement("a");
            link.href = `${baseURL}/category/${encodeURIComponent(state.name)}`;
            const listingsCount = provinceData[state.name] ? provinceData[state.name].listings_count : 0;
            fetchAllData
            link.textContent = `${state.name} (${listingsCount})`;
            link.style.color = state.color; 
            link.style.textDecoration = "none";
            link.addEventListener("click", (event) => {
                event.preventDefault();
                window.location.href = link.href;
            });
            cell.appendChild(link);
            row.appendChild(cell);
        });
    
};

// Panggil fungsi untuk membuat tabel legenda
// createLegendTable();




    initializeMap();
</script>

</section>

<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\apindo\resources\views/themes/classic/sections/maps.blade.php ENDPATH**/ ?>