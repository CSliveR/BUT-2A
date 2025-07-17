const grades = [];

document.querySelector('#addGradeBtn').addEventListener("click",() => {
    let note = parseFloat(prompt("Entrez une note"));

    if(isNaN(note) || note < 0.0 || note > 20.0){
        alert("La note saisie n'est pas valide");
    }else{
        grades.push(note);
        document.querySelector('ul').innerHTML += "<li>" + note + "</li>";
    }
    
    document.querySelector('#minGrade td:last-child').innerHTML = minGrade(grades);
    document.querySelector('#nbGradesBelow10 td:last-child').innerHTML = nbGradesBelow10(grades);
    document.querySelector('#averageGrade td:last-child').innerHTML = averageGrade(grades);
    document.querySelector('#maxGrade td:last-child').innerHTML = maxGrade(grades);
});

function minGrade(grades){
    let min = grades[0];
    for(let i=1; i < grades.length; i++){
        if(grades[i] < min){
            min = grades[i];
        }
    }
    return min;
}

function maxGrade(grades){
    let max = grades[0];
    for(let i=1; i < grades.length; i++){
        if(grades[i] > max){
            max = grades[i];
        }
    }
    return max;
}

function nbGradesBelow10(grades){
    let nbGrades = 0;
    for(let i=0; i < grades.length; i++){
        if(grades[i] < 10){
            nbGrades++;
        }
    }
    return nbGrades;
}


function averageGrade(grades){
    let sumGrades = 0.0;
    for(let i=0; i < grades.length; i++){
        sumGrades += grades[i];
    }

    return (sumGrades/grades.length).toFixed(2);
}















