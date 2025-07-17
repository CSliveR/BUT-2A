package fr.iut.androidprojet.gamesActs.math;

import static android.content.Intent.FLAG_ACTIVITY_CLEAR_TASK;
import static android.content.Intent.FLAG_ACTIVITY_NEW_TASK;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import fr.iut.androidprojet.MotherActivity;
import fr.iut.androidprojet.R;

public class ErreurActivity extends MotherActivity {
    private TextView erreursView;
    private Button autreOperationBtn;
    private Button corrigerBtn;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_erreur);

        erreursView = findViewById(R.id.text_erreurs);
        autreOperationBtn = findViewById(R.id.autreOperation_button);
        corrigerBtn = findViewById(R.id.corriger_button);

        Intent intentFromOperationActivity = getIntent();
        int nbErreurs = intentFromOperationActivity.getIntExtra(OperationActivity.NOMBRE_ERREURS,1);
        erreursView.setText(getString(R.string.nombre_d_erreurs) + " " + nbErreurs);

        autreOperationBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent operationActivityIntent = new Intent(ErreurActivity.this, MathActivity.class);
                operationActivityIntent.addFlags(FLAG_ACTIVITY_CLEAR_TASK | FLAG_ACTIVITY_NEW_TASK);
                startActivity(operationActivityIntent);

            }
        });

        corrigerBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });
    }
}