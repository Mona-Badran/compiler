import { useRef, useState, useEffect } from "react";
import { Box, HStack } from "@chakra-ui/react";
import { Editor } from "@monaco-editor/react";
import LanguageSelector from "./LanguageSelector";
import Output from "./Output";
import axios from "axios";
import { useParams } from "react-router-dom";

const CodeEditor = () => {
  const editorRef = useRef();
  const { id } = useParams();
  const [workFiles, setWorkFiles] = useState("");
  const [value, setValue] = useState("");
  const [language, setLanguage] = useState("python");

  const loadWorkspaceDetails = () => {
    axios
      .post(
        `http://127.0.0.1:8000/api/get_file/${encodeURIComponent(id)}`,
        {},
        {
          headers: {
            Authorization: `Bearer ${localStorage.getItem("token")}`,
          },
        }
      )
      .then((response) => {
        const fileContent = response.data.content || "";
        setWorkFiles(fileContent);
        setValue(fileContent);
      })
      .catch((err) => {
        console.error("Error fetching workspace files", err);
      });
  };

  useEffect(() => {
    loadWorkspaceDetails();
  }, [id]);

  const onMount = (editor) => {
    editorRef.current = editor;
    editor.focus();
  };

  const onSelect = (newLanguage) => {
    setLanguage(newLanguage);
    const snippet = CODE_SNIPPETS[newLanguage] || "";
    setValue(snippet);
  };

  return (
    <Box>
      <HStack spacing={4}>
        <Box w="50%">
          <LanguageSelector language={language} onSelect={onSelect} />
          <Editor
            options={{
              minimap: { enabled: false },
            }}
            height="75vh"
            theme="vs-dark"
            language={language}
            value={value}
            onMount={onMount}
            onChange={(newValue) => setValue(newValue)}
          />
        </Box>
        <Output editorRef={editorRef} language={language} />
      </HStack>
    </Box>
  );
};

export default CodeEditor;
