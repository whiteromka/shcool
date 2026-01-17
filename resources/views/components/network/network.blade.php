<style>
    #network {
        /*width: 600px;*/
        height: 600px;
        border-radius: 14px;
        /*background:*/
        /*    radial-gradient(circle at 20% 10%, #1f2937 0%, transparent 60%),*/
        /*    radial-gradient(circle at 80% 80%, #11302e 0%, transparent 55%),*/
        /*    #020617;*/
        /*box-shadow:*/
        /*    0 0 60px rgba(0, 255, 200, 0.12),*/
        /*    inset 0 0 40px rgba(0, 0, 0, 0.85);*/
        /*margin: auto;*/
    }
</style>

<div id="network"></div>

<script src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
<script>
    let size = 24;
    let colorBackground = "#fc0000";
    let colorBorder = "#45fff4";
    let borderWidth = 5;
    let fontSize = 43;
    let fontColor = "#f9f9f9";
    let fontFace = "Orbitron";

    const nodes = new vis.DataSet([
        // Левая группа
        { id: 1, label: "JavaScript", group: "left" },
        { id: 2, label: "DOM", group: "left" },
        { id: 3, label: "Async", group: "left" },
        { id: 4, label: "Vue", group: "left" },
        { id: 5, label: "React", group: "left" },

        // Правая группа
        { id: 6, label: "Node", group: "right" },
        { id: 7, label: "Express", group: "right" },
        { id: 8, label: "MongoDB", group: "right" },
        { id: 9, label: "Redis", group: "right" },
        { id: 10, label: "Docker", group: "right" }
    ]);

    const edges = new vis.DataSet([
        { from: 1, to: 2 },
        { from: 1, to: 3 },
        { from: 2, to: 4 },
        { from: 1, to: 5 },
        { from: 5, to: 6 },

        { from: 6, to: 7 },
        { from: 7, to: 8 },
        { from: 8, to: 9 },
        { from: 9, to: 10 }
    ]);

    const options = {
        physics: {
            enabled: true,
            solver: "forceAtlas2Based",
            forceAtlas2Based: {
                gravitationalConstant: -60,
                centralGravity: 0.001,
                springLength: 180,
                springConstant: 0.05,
                damping: 0.6,
                avoidOverlap: 1
            },
            stabilization: { iterations: 200, fit: true }
        },
        nodes: {
            shape: "dot",
            size: size,
            color: {
                background: colorBackground,
                border: colorBorder,
                highlight: { background: "#ffffff", border: "#ffffff" }
            },
            borderWidth: borderWidth,
            font: {
                color: fontColor,
                size: fontSize,
                // bold: true,
                // face: fontFace,
                strokeWidth: 4,
                strokeColor: "#151515"
            }
        },
        edges: {
            color: { color: "#334155", highlight: "#5eead4", hover: "#5eead4" },
            width: 1.2,
            selectionWidth: 5,
            hoverWidth: 3,
            smooth: { type: "continuous", roundness: 0.25 }
        },
        groups: {
            left: {
                color: { background: "#fc0000", border: "#45fff4", highlight: { background: "#ffffff", border: "#ffffff" } }
            },
            right: {
                color: { background: "#00ffb3", border: "#00cc99", highlight: { background: "#ffffff", border: "#ffffff" } }
            }
        },
        interaction: { hover: true, zoomSpeed: 0.6 }
    };

    const network = new vis.Network(
        document.getElementById("network"),
        { nodes, edges },
        options
    );

    // network.once("stabilizationIterationsDone", function () {
    //     network.moveTo({
    //         position: { x: 0, y: 0 },
    //         scale: 0.3,
    //         offset: { x: 0, y: 0 }
    //     });
    // });

    // Разделяем группы в пространстве
    network.on("afterDrawing", () => {
        nodes.forEach(node => {
            if (node.group === "left" && node.x > 0) {
                nodes.update({ id: node.id, x: node.x - 300 });
            }
            if (node.group === "right" && node.x < 0) {
                nodes.update({ id: node.id, x: node.x + 300 });
            }
        });
    });

    // Добавляем обработчик клика
    network.on("click", function (params) {
        if (params.nodes.length > 0) { // проверяем, что кликнули по узлу
            const nodeId = params.nodes[0];
            const node = nodes.get(nodeId);
            console.log("Клик на узле:", node.id, node.label);
        }
    });


    // Срабатывает после того, как пользователь закончил перетаскивать узел
    network.on("dragStart", function (params) {
        if (params.nodes.length > 0) { // проверяем, что перетащили узел
            const nodeId = params.nodes[0];
            const node = nodes.get(nodeId);
            console.log(`Узел таскают: ID=${node.id}, Label=${node.label}, Новые координаты: x=${node.x}, y=${node.y}`);
        }
    });
</script>
