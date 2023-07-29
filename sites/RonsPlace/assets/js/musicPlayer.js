const musicPlayer = (containerId, midiFilePath) => {
  const labelStates = {
    PLAY: 'Play',
    STOP: 'Stop',
  };
  let isPlaying = false;
  const button = document.createElement("button");
  button.id = "midiPlayer";
  button.innerText = labelStates.PLAY;
  button.style.fontSize = '11px';
  button.type = 'button';
  button.addEventListener("click", () => {
    if (isPlaying === true) {
      MIDIjs.stop();
      button.innerText = labelStates.PLAY;
    } else {
      MIDIjs.play(midiFilePath);
      button.innerText = labelStates.STOP;
    }
    isPlaying = !isPlaying;
  });
  document.querySelector(containerId).appendChild(button);
};
