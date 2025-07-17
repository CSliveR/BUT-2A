package fr.iut2.androidtp.exercice5Acts;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.NumberPicker;

import androidx.appcompat.app.AppCompatActivity;

import fr.iut2.androidtp.R;

public class Exercice5Activity extends AppCompatActivity {
    public static final String NOMBRE_CHOISI = "pickedNumber";
    private NumberPicker numberPicker;
    private Button btnValider;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // On charge le XML pour créer l'arbre graphique
        setContentView(R.layout.activity_exercice5);
        numberPicker = findViewById(R.id.exercice5_numberPicker);
        numberPicker.setMinValue(1); numberPicker.setValue(1); numberPicker.setMaxValue(9);
        btnValider = findViewById(R.id.exercice5_btnValider);

        btnValider.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                int pickedNumber = numberPicker.getValue();
                Intent tableMultiplicationActivityIntent = new Intent(Exercice5Activity.this, TableMultiplicationActivity.class);
                tableMultiplicationActivityIntent.putExtra(Exercice5Activity.NOMBRE_CHOISI, pickedNumber);
                startActivity(tableMultiplicationActivityIntent);
            }
        });
    }
}
