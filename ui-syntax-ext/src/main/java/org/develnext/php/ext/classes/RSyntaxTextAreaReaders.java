package org.develnext.php.ext.classes;

import org.fife.ui.rsyntaxtextarea.RSyntaxTextArea;
import php.runtime.ext.swing.loader.support.PropertyReader;
import php.runtime.ext.swing.loader.support.Value;
import php.runtime.ext.swing.loader.support.propertyreaders.PropertyReaders;

import java.util.HashMap;
import java.util.Map;

public class RSyntaxTextAreaReaders extends PropertyReaders<RSyntaxTextArea> {

    protected final Map<String, PropertyReader<RSyntaxTextArea>> register = new HashMap<String, PropertyReader<RSyntaxTextArea>>(){{
        put("syntax-style", SYNTAX_STYLE);
    }};

    @Override
    protected Map<String, PropertyReader<RSyntaxTextArea>> getRegister() {
        return register;
    }

    @Override
    public Class<RSyntaxTextArea> getRegisterClass() {
        return RSyntaxTextArea.class;
    }

    public final static PropertyReader<RSyntaxTextArea> SYNTAX_STYLE = new PropertyReader<RSyntaxTextArea>() {
        @Override
        public void read(RSyntaxTextArea rSyntaxTextArea, Value value) {
            rSyntaxTextArea.setSyntaxEditingStyle(value.asString());
        }
    };
}
