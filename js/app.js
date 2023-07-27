const traineeCv         = document.getElementById('trainee-cv');
const traineeCvLabel    = document.getElementById('trainee-cv-label');

if (traineeCv !== null )
{
    traineeCv.addEventListener('change', function (event) {
        
        let filename = traineeCv.files[0].name;
        traineeCvLabel.innerText = filename;
        
    });

}

const traineeLetter         = document.getElementById('trainee-letter');
const traineeLetterLabel    = document.getElementById('trainee-letter-label');

if (traineeLetter !== null )
{
    traineeLetter.addEventListener('change', function (event) {

        let filename = traineeLetter.files[0].name;
        traineeLetterLabel.innerText = filename;
    
    });

}