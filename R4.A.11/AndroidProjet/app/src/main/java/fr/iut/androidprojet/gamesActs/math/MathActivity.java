package fr.iut.androidprojet.gamesActs.math;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;
import android.view.View;
import android.widget.CompoundButton;
import android.widget.PopupMenu;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ToggleButton;

import java.util.Arrays;
import java.util.List;

import fr.iut.androidprojet.MotherActivity;
import fr.iut.androidprojet.R;

public class MathActivity extends MotherActivity {
    private ToggleButton melangeBtn;
    private boolean estMelange = false;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_math);

        setupPopupMenu(R.id.text_addition, Arrays.asList("Niveau 1", "Niveau 2", "Niveau 3"));
        setupPopupMenu(R.id.text_subtraction, Arrays.asList("Niveau 1", "Niveau 2", "Niveau 3"));
        setupPopupMenu(R.id.text_multiplication, Arrays.asList("Niveau 1", "Niveau 2", "Niveau 3"));
        setupPopupMenu(R.id.text_division, Arrays.asList("Niveau 1", "Niveau 2", "Niveau 3"));

        melangeBtn = findViewById(R.id.button_melange);

        melangeBtn.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                estMelange = isChecked;
            }
        });
        /*
        melangeBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                estMelange = !estMelange;
            }
        });*/
    }
    private void setupPopupMenu(int textViewId, List<String> levels) {
        TextView operationTextView = findViewById(textViewId);

        operationTextView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                PopupMenu levelPopupMenu = new PopupMenu(view.getContext(), operationTextView);

                for (int levelIndex = 0; levelIndex < levels.size(); levelIndex++) {
                    String levelLabel = levels.get(levelIndex);
                    levelPopupMenu.getMenu().add(0, levelIndex, levelIndex, levelLabel);
                }

                levelPopupMenu.setOnMenuItemClickListener(new PopupMenu.OnMenuItemClickListener() {
                    @Override
                    public boolean onMenuItemClick(MenuItem menuItem) {
                        int selectedLevelIndex = menuItem.getItemId();
                        String selectedLevel = levels.get(selectedLevelIndex);
                        Intent operationActivityIntent;
                        if(operationTextView.getText().toString().compareTo("Multiplication") == 0 && selectedLevelIndex == 0){
                            operationActivityIntent = new Intent(MathActivity.this, MultiplicationNPActivity.class);
                        }else{
                            operationActivityIntent = new Intent(MathActivity.this, OperationActivity.class);
                        }
                        operationActivityIntent.putExtra("operation", operationTextView.getText());
                        operationActivityIntent.putExtra("level", selectedLevel);
                        operationActivityIntent.putExtra("melange", estMelange);
                        startActivity(operationActivityIntent);
                        Toast.makeText(operationTextView.getContext(), operationTextView.getText().toString() + " : " + selectedLevel, Toast.LENGTH_SHORT).show();
                        return true;
                    }
                });
                levelPopupMenu.show();
            }
        });
    }
}
