document.addEventListener('DOMContentLoaded', function () {
    const gridBackground = document.getElementById('gridBackground');
    const squareSize = 160;

    // 👉 массив всех point
    let points = [];

    function createGrid() {
        gridBackground.innerHTML = '';
        points = [];

        const windowWidth = window.innerWidth;
        const windowHeight = window.innerHeight;

        const squaresHorizontal = Math.ceil(windowWidth / squareSize) + 1;
        const squaresVertical = Math.ceil(windowHeight / squareSize) + 1;
        const totalSquares = squaresHorizontal * squaresVertical;

        for (let i = 0; i < totalSquares; i++) {
            const square = document.createElement('div');
            square.className = 'grid-square';

            const point = document.createElement('div');
            point.className = 'grid-point';

            square.appendChild(point);

            if (windowWidth < 768) {
                square.style.width = '150px';
                square.style.height = '150px';
                point.style.width = '4px';
                point.style.height = '4px';
            }

            if (windowWidth < 480) {
                square.style.width = '100px';
                square.style.height = '100px';
                point.style.width = '3px';
                point.style.height = '3px';
            }

            gridBackground.appendChild(square);

            // 👉 сохраняем point
            points.push(point);
        }
    }

    // helper для задержек
    const sleep = ms => new Promise(resolve => setTimeout(resolve, ms));
    // анимация по очереди
    async function animatePoints() {
        for (const point of points) {
            point.style.background = '#6bf20a';
            point.style.boxShadow = '0 0 5px 2px rgba(51, 255, 0, 0.5)';

            const square = point.parentElement;
            if (square) {
                // outline: 1px solid rgba(98, 255, 0, 0.11);
                square.style.outline = '1px solid rgba(98, 255, 0, 0.11)';
            }
            await sleep(1000);
        }
    }
    window.animatePoints = animatePoints;

    createGrid();

    // window.addEventListener('resize', createGrid);
    // setTimeout(() => {
    //     animatePoints();
    // }, 2000);
});
