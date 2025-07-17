package fr.iut2.androidtp;

import android.os.Bundle;
import android.text.TextUtils;
import android.view.View;
import android.widget.EditText;
import android.widget.TextView;
import androidx.appcompat.app.AppCompatActivity;

public class Exercice1Activity extends AppCompatActivity {
    private TextView helloView;
    private EditText prenomView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        // On charge le XML pour créer l'arbre graphique
        setContentView(R.layout.activity_exercice1);
        // On récupére les objets de l'arbre graphique (à l'aide de leur id)
        helloView = findViewById(R.id.exercice1_hello);
        prenomView = findViewById(R.id.exercice1_prenom);
    }

    public void exercice1_valider(View view) {
        // On affiche le message si un prénom a été défini
        if (!TextUtils.isEmpty(prenomView.getText())) {
            helloView.setText("Hello " + prenomView.getText() + " !");
        }
    }
}
