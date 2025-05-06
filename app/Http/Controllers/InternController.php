// Assuming you have an InternController that loads the home page
// Update the method that loads the home page to include comments

public function home()
{
    $intern = auth()->user()->intern;
    $intern->load(['user', 'tasks.comments.user']);
    
    return view('interns.home', compact('intern'));
}