package fr.iut2.androidtp.exercice5Acts;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import androidx.appcompat.app.AppCompatActivity;

import fr.iut2.androidtp.MainActivity;
import fr.iut2.androidtp.R;

public class FelicitationActivity extends AppCompatActivity {
    private Button btnAutreTable;
    private Button btnAutreExo;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // On charge le XML pour créer l'arbre graphique
        setContentView(R.layout.activity_felicitation);
        btnAutreTable = findViewById(R.id.exercice5_btnAutreTable);
        btnAutreExo = findViewById(R.id.exercice5_btnAutreExo);

        btnAutreTable.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent exercice5ActivityIntent = new Intent(FelicitationActivity.this, Exercice5Activity.class);
                startActivity(exercice5ActivityIntent);
            }
        });

        btnAutreExo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent mainActivityIntent = new Intent(FelicitationActivity.this, MainActivity.class);
                startActivity(mainActivityIntent);
            }
        });

    }
}