package fr.iut.androidprojet.gamesActs.math;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.NumberPicker;

import fr.iut.androidprojet.MotherActivity;
import fr.iut.androidprojet.R;

/*NP means NumberPicker*/
public class MultiplicationNPActivity extends MotherActivity {
    public static final String NOMBRE_CHOISI = "pickedNumber";
    private NumberPicker numberPicker;
    private Button btnValider;
    private boolean estMelange;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // On charge le XML pour créer l'arbre graphique
        setContentView(R.layout.activity_multiplication_np);
        numberPicker = findViewById(R.id.multiplication_numberPicker);
        numberPicker.setMinValue(1); numberPicker.setValue(1); numberPicker.setMaxValue(9);
        btnValider = findViewById(R.id.button_valider);

        Intent intentFromMathActivity = getIntent();
        estMelange = intentFromMathActivity.getBooleanExtra("melange", false);

        btnValider.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v) {
                int pickedNumber = numberPicker.getValue();
                Intent operationActivityIntent = new Intent(MultiplicationNPActivity.this, OperationActivity.class);
                operationActivityIntent.putExtra(MultiplicationNPActivity.NOMBRE_CHOISI, pickedNumber);
                operationActivityIntent.putExtra("operation", "Multiplication");
                operationActivityIntent.putExtra("level", "Niveau 1");
                operationActivityIntent.putExtra("melange", estMelange);
                startActivity(operationActivityIntent);
            }
        });
    }
}