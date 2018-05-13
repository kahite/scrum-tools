import Board from '../components/Board.html';

const board = new Board({
	target: document.querySelector('.container'),
	data: {
    sprint: window.sprint
  }
});

export default board;
